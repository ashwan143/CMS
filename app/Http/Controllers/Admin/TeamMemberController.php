<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $teamMembers = TeamMember::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('designation', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.team-members.index', compact('teamMembers', 'search'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create()
    {
        return view('admin.team-members.create');
    }

    /**
     * Store a newly created team member.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'designation' => 'nullable|string|max:191',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.linkedin' => 'nullable|url|max:191',
            'social_links.facebook' => 'nullable|url|max:191',
            'social_links.instagram' => 'nullable|url|max:191',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request
                ->file('profile_image')
                ->store('team-members', 'public');
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['created_by'] = auth()->id();

        TeamMember::create($validated);

        return redirect()
            ->route('team-members.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified team member.
     */
    public function show(TeamMember $teamMember)
    {
        return view('admin.team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified team member.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'designation' => 'nullable|string|max:191',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.linkedin' => 'nullable|url|max:191',
            'social_links.facebook' => 'nullable|url|max:191',
            'social_links.instagram' => 'nullable|url|max:191',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->boolean('remove_image')) {
            if (
                $teamMember->profile_image &&
                Storage::disk('public')->exists($teamMember->profile_image)
            ) {
                Storage::disk('public')->delete($teamMember->profile_image);
            }

            $validated['profile_image'] = null;
        }

        if ($request->hasFile('profile_image')) {
            if (
                $teamMember->profile_image &&
                Storage::disk('public')->exists($teamMember->profile_image)
            ) {
                Storage::disk('public')->delete($teamMember->profile_image);
            }

            $validated['profile_image'] = $request
                ->file('profile_image')
                ->store('team-members', 'public');
        }

        unset($validated['remove_image']);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');

        $teamMember->update($validated);

        return redirect()
            ->route('team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified team member.
     */
    public function destroy(TeamMember $teamMember)
    {
        if (
            $teamMember->profile_image &&
            Storage::disk('public')->exists($teamMember->profile_image)
        ) {
            Storage::disk('public')->delete($teamMember->profile_image);
        }

        $teamMember->delete();

        return redirect()
            ->route('team-members.index')
            ->with('success', 'Team member deleted successfully.');
    }
}

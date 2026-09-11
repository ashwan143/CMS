<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $clients = Client::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('industry', 'like', '%' . $search . '%')
                        ->orWhere('website', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:clients,slug',
            'industry' => 'nullable|string|max:191',
            'website' => 'nullable|url|max:191',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        // Generate slug automatically if empty
        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        }

        // Upload logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        // Default values
        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['created_by'] = auth()->id();

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified client.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:clients,slug,' . $client->id,
            'industry' => 'nullable|string|max:191',
            'website' => 'nullable|url|max:191',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'remove_logo' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        // Generate slug automatically if empty
        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug(
                $validated['name'],
                $client->id
            );
        }

        // Remove existing logo
        if ($request->boolean('remove_logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            $validated['logo'] = null;
        }

        // Replace logo with new logo
        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        // Remove helper field before update
        unset($validated['remove_logo']);

        // Default values
        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client)
    {
        // Delete logo from storage
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        // Delete client record
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    /**
     * Generate a unique slug.
     */
    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Client::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

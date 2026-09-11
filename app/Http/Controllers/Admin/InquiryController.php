<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $inquiries = Inquiry::query()
            ->with('assignedUser')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('subject', 'like', '%' . $search . '%')
                        ->orWhere('type', 'like', '%' . $search . '%');
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.inquiries.index',
            compact('inquiries', 'search')
        );
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Inquiry $inquiry)
    {
        $users = User::orderBy('name')->get();

        return view(
            'admin.inquiries.show',
            compact('inquiry', 'users')
        );
    }

    /**
     * Update inquiry status.
     */
    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|integer|min:0|max:3',
        ]);

        $inquiry->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Inquiry status updated successfully.');
    }

    /**
     * Assign inquiry to an admin user.
     */
    public function assign(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $inquiry->update([
            'assigned_to' => $validated['assigned_to'] ?? null,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Inquiry assignment updated successfully.');
    }

    /**
     * Remove the specified inquiry.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->route('inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}

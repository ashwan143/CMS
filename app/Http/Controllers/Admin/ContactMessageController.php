<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $messages = ContactMessage::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('subject', 'like', '%' . $search . '%');
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.contact-messages.index', compact('messages', 'search'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark the message as read when opened.
        if (!$contactMessage->is_read) {
            $contactMessage->update([
                'is_read' => true,
            ]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Mark the specified message as read.
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update([
            'is_read' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Message marked as read.');
    }

    /**
     * Mark the specified message as unread.
     */
    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->update([
            'is_read' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Message marked as unread.');
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}

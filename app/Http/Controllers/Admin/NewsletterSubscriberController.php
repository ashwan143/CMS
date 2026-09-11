<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display a listing of newsletter subscribers.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $subscribers = NewsletterSubscriber::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->latest('subscribed_at')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.newsletter-subscribers.index',
            compact('subscribers', 'search')
        );
    }

    /**
     * Display the specified subscriber.
     */
    public function show(NewsletterSubscriber $newsletterSubscriber)
    {
        return view(
            'admin.newsletter-subscribers.show',
            compact('newsletterSubscriber')
        );
    }

    /**
     * Update subscriber status.
     */
    public function updateStatus(
        Request $request,
        NewsletterSubscriber $newsletterSubscriber
    ) {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $newsletterSubscriber->update([
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Subscriber status updated successfully.');
    }

    /**
     * Remove the specified subscriber.
     */
    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        $newsletterSubscriber->delete();

        return redirect()
            ->route('newsletter-subscribers.index')
            ->with('success', 'Subscriber deleted successfully.');
    }
}

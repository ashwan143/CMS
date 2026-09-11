<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Blog;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\Inquiry;
use App\Models\JobOpening;
use App\Models\NewsletterSubscriber;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'clients' => Client::count(),
            'projects' => Project::count(),
            'services' => Service::count(),
            'blogs' => Blog::count(),
            'team_members' => TeamMember::count(),
            'job_openings' => JobOpening::count(),
        ];

        $leadStats = [
            'inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 0)->count(),
            'contact_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'subscribers' => NewsletterSubscriber::count(),
        ];

        $activityLabels = [];
        $activityData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $activityLabels[] = $date->format('M');

            $activityData[] = ActivityLog::whereYear(
                'created_at',
                $date->year
            )
                ->whereMonth(
                    'created_at',
                    $date->month
                )
                ->count();
        }

        $recentInquiries = Inquiry::latest()
            ->take(5)
            ->get();

        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'leadStats',
            'activityLabels',
            'activityData',
            'recentInquiries',
            'recentMessages',
            'recentActivities'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $logs = ActivityLog::query()
            ->with('user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('action', 'like', '%' . $search . '%')
                        ->orWhere('module', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('ip_address', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.activity-logs.index',
            compact('logs', 'search')
        );
    }

    /**
     * Display the specified activity log.
     */
    public function show(ActivityLog $activityLog)
    {
        return view(
            'admin.activity-logs.show',
            compact('activityLog')
        );
    }

    /**
     * Remove the specified activity log.
     */
    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();

        return redirect()
            ->route('activity-logs.index')
            ->with('success', 'Activity log deleted successfully.');
    }
}

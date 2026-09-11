@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    {{-- ============================= --}}
    {{-- PAGE HEADER --}}
    {{-- ============================= --}}

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Welcome back, {{ auth()->user()->name }} 👋
            </h2>

            <p class="text-muted mb-0">
                Here's what's happening across your company website today.
            </p>
        </div>

        <div class="mt-3 mt-md-0">

            <a
                href="{{ route('inquiries.index') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-chat-left-text me-1"></i>
                View Inquiries
            </a>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- CORE STATISTICS --}}
    {{-- ============================= --}}

    <div class="row g-4">

        {{-- Users --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted mb-1">
                                Total Users
                            </p>

                            <h2 class="fw-bold mb-2">
                                {{ $stats['users'] }}
                            </h2>

                            <small class="text-muted">
                                Administrators & users
                            </small>

                        </div>

                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-people fs-4 text-primary"></i>
                        </div>

                    </div>

                    <div class="mt-3">

                        <a
                            href="{{ route('users.index') }}"
                            class="text-decoration-none small"
                        >
                            Manage users →
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Clients --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Clients
                            </p>

                            <h2 class="fw-bold mb-2">
                                {{ $stats['clients'] }}
                            </h2>

                            <small class="text-muted">
                                Company clients
                            </small>

                        </div>

                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-building fs-4 text-success"></i>
                        </div>

                    </div>

                    <div class="mt-3">

                        <a
                            href="{{ route('clients.index') }}"
                            class="text-decoration-none small"
                        >
                            View clients →
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Projects --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Projects
                            </p>

                            <h2 class="fw-bold mb-2">
                                {{ $stats['projects'] }}
                            </h2>

                            <small class="text-muted">
                                Portfolio projects
                            </small>

                        </div>

                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-kanban fs-4 text-warning"></i>
                        </div>

                    </div>

                    <div class="mt-3">

                        <a
                            href="{{ route('projects.index') }}"
                            class="text-decoration-none small"
                        >
                            Manage projects →
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Services --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted mb-1">
                                Services
                            </p>

                            <h2 class="fw-bold mb-2">
                                {{ $stats['services'] }}
                            </h2>

                            <small class="text-muted">
                                Company services
                            </small>

                        </div>

                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-gear fs-4 text-info"></i>
                        </div>

                    </div>

                    <div class="mt-3">

                        <a
                            href="{{ route('services.index') }}"
                            class="text-decoration-none small"
                        >
                            Manage services →
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- LEADS / COMMUNICATION --}}
    {{-- ============================= --}}

    <div class="row g-4 mt-1">

        {{-- Inquiries --}}
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-chat-left-text fs-4 text-primary"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Total Inquiries
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $leadStats['inquiries'] }}
                            </h4>

                        </div>

                    </div>

                    <div class="mt-3 pt-3 border-top">

                        <span class="badge bg-primary">
                            {{ $leadStats['new_inquiries'] }} New
                        </span>

                        <a
                            href="{{ route('inquiries.index') }}"
                            class="float-end small text-decoration-none"
                        >
                            View →
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Messages --}}
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="bi bi-envelope fs-4 text-danger"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Contact Messages
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $leadStats['contact_messages'] }}
                            </h4>

                        </div>

                    </div>

                    <div class="mt-3 pt-3 border-top">

                        <span class="badge bg-danger">
                            {{ $leadStats['unread_messages'] }} Unread
                        </span>

                        <a
                            href="{{ route('contact-messages.index') }}"
                            class="float-end small text-decoration-none"
                        >
                            View →
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Newsletter --}}
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-newspaper fs-4 text-success"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Newsletter Subscribers
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $leadStats['subscribers'] }}
                            </h4>

                        </div>

                    </div>

                    <div class="mt-3 pt-3 border-top">

                        <a
                            href="{{ route('newsletter-subscribers.index') }}"
                            class="small text-decoration-none"
                        >
                            Manage subscribers →
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- CHART + QUICK ACTIONS --}}
    {{-- ============================= --}}

    <div class="row g-4 mt-2">

        {{-- Activity Chart --}}
        <div class="col-xl-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Admin Activity
                            </h5>

                            <small class="text-muted">
                                Activity recorded during the last six months
                            </small>

                        </div>

                        <a
                            href="{{ route('activity-logs.index') }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            View Logs
                        </a>

                    </div>

                    <div style="height:320px;">
                        <canvas id="activityChart"></canvas>
                    </div>

                </div>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="col-xl-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h5 class="fw-bold mb-1">
                        Quick Actions
                    </h5>

                    <p class="text-muted small mb-4">
                        Common content management actions
                    </p>

                    <div class="d-grid gap-2">

                        <a
                            href="{{ route('projects.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-plus-circle me-2"></i>
                            Add Project
                        </a>

                        <a
                            href="{{ route('services.create') }}"
                            class="btn btn-outline-primary"
                        >
                            <i class="bi bi-gear me-2"></i>
                            Add Service
                        </a>

                        <a
                            href="{{ route('blogs.create') }}"
                            class="btn btn-outline-success"
                        >
                            <i class="bi bi-journal-plus me-2"></i>
                            Add Blog
                        </a>

                        <a
                            href="{{ route('team-members.create') }}"
                            class="btn btn-outline-info"
                        >
                            <i class="bi bi-person-plus me-2"></i>
                            Add Team Member
                        </a>

                        <a
                            href="{{ route('job-openings.create') }}"
                            class="btn btn-outline-dark"
                        >
                            <i class="bi bi-briefcase me-2"></i>
                            Add Job Opening
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- RECENT INQUIRIES --}}
    {{-- ============================= --}}

    <div class="row g-4 mt-2">

        <div class="col-xl-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Recent Inquiries
                            </h5>

                            <small class="text-muted">
                                Latest customer leads
                            </small>

                        </div>

                        <a
                            href="{{ route('inquiries.index') }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            View All
                        </a>

                    </div>


                    @forelse($recentInquiries as $inquiry)

                        <div class="d-flex align-items-center py-3 border-bottom">

                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="bi bi-person text-primary"></i>
                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">
                                    {{ $inquiry->name }}
                                </div>

                                <small class="text-muted">
                                    {{ $inquiry->subject ?? 'General Inquiry' }}
                                </small>

                            </div>

                            <div class="text-end">

                                <small class="text-muted d-block">
                                    {{ $inquiry->created_at?->format('d M Y') }}
                                </small>

                                <a
                                    href="{{ route('inquiries.show', $inquiry) }}"
                                    class="small text-decoration-none"
                                >
                                    View
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5">

                            <i class="bi bi-inbox fs-1 text-muted"></i>

                            <p class="text-muted mt-2 mb-0">
                                No inquiries yet.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- RECENT CONTACT MESSAGES --}}
        {{-- ============================= --}}

        <div class="col-xl-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Contact Messages
                            </h5>

                            <small class="text-muted">
                                Latest website messages
                            </small>

                        </div>

                        <a
                            href="{{ route('contact-messages.index') }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            View All
                        </a>

                    </div>


                    @forelse($recentMessages as $message)

                        <div class="py-3 border-bottom">

                            <div class="d-flex justify-content-between">

                                <strong>
                                    {{ $message->name }}
                                </strong>

                                @if(!$message->is_read)

                                    <span class="badge bg-danger">
                                        New
                                    </span>

                                @endif

                            </div>

                            <div class="small text-muted mt-1">
                                {{ $message->subject ?? 'No Subject' }}
                            </div>

                            <div class="small text-muted mt-1">
                                {{ \Illuminate\Support\Str::limit($message->message, 70) }}
                            </div>

                            <div class="mt-2">

                                <a
                                    href="{{ route('contact-messages.show', $message) }}"
                                    class="small text-decoration-none"
                                >
                                    Read Message →
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-5">

                            <i class="bi bi-envelope-open fs-1 text-muted"></i>

                            <p class="text-muted mt-2 mb-0">
                                No contact messages yet.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- WEBSITE OVERVIEW --}}
    {{-- ============================= --}}

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body">

            <h5 class="fw-bold mb-4">
                Website Overview
            </h5>

            <div class="row g-4">

                <div class="col-lg-3 col-md-6">

                    <div class="d-flex align-items-center">

                        <i class="bi bi-journal-text fs-3 text-primary me-3"></i>

                        <div>

                            <small class="text-muted">
                                Blogs
                            </small>

                            <div class="fw-bold fs-5">
                                {{ $stats['blogs'] }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="d-flex align-items-center">

                        <i class="bi bi-people fs-3 text-success me-3"></i>

                        <div>

                            <small class="text-muted">
                                Team
                            </small>

                            <div class="fw-bold fs-5">
                                {{ $stats['team_members'] }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="d-flex align-items-center">

                        <i class="bi bi-briefcase fs-3 text-warning me-3"></i>

                        <div>

                            <small class="text-muted">
                                Open Jobs
                            </small>

                            <div class="fw-bold fs-5">
                                {{ $stats['job_openings'] }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="d-flex align-items-center">

                        <i class="bi bi-activity fs-3 text-danger me-3"></i>

                        <div>

                            <small class="text-muted">
                                Activity Logs
                            </small>

                            <div class="fw-bold fs-5">
                                {{ \App\Models\ActivityLog::count() }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('activityChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    new Chart(canvas, {

        type: 'line',

        data: {

            labels: @json($activityLabels),

            datasets: [{
                label: 'Admin Activity',
                data: @json($activityData),

                borderWidth: 2,

                tension: 0.35,

                fill: true
            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }

                }

            }

        }

    });

});

</script>

@endpush

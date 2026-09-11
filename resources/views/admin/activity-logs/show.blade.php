@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Activity Log Details</h1>
            <p class="text-muted mb-0">View administrator activity details.</p>
        </div>

        <a
            href="{{ route('activity-logs.index') }}"
            class="btn btn-secondary"
        >
            Back to Activity Logs
        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                {{-- User --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">User</h5>

                    @if($activityLog->user)

                        <p class="mb-1">
                            <strong>Name:</strong>
                            {{ $activityLog->user->name }}
                        </p>

                        <p>
                            <strong>Email:</strong>
                            <a href="mailto:{{ $activityLog->user->email }}">
                                {{ $activityLog->user->email }}
                            </a>
                        </p>

                    @else

                        <p class="text-muted">
                            System / Deleted User
                        </p>

                    @endif

                </div>

                {{-- Activity --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">Activity</h5>

                    <p class="mb-1">
                        <strong>Action:</strong>

                        <span class="badge bg-primary">
                            {{ $activityLog->action }}
                        </span>
                    </p>

                    <p>
                        <strong>Module:</strong>
                        {{ $activityLog->module ?? '-' }}
                    </p>

                </div>

            </div>

            <hr>

            {{-- Description --}}
            <div class="mb-4">

                <h5 class="mb-3">Description</h5>

                @if($activityLog->description)

                    <div class="border rounded p-3 bg-light">
                        {!! nl2br(e($activityLog->description)) !!}
                    </div>

                @else

                    <p class="text-muted">
                        No description available.
                    </p>

                @endif

            </div>

            <hr>

            {{-- Request Information --}}
            <div class="mb-4">

                <h5 class="mb-3">Request Information</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>IP Address</strong>

                        <div>
                            {{ $activityLog->ip_address ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Date & Time</strong>

                        <div>
                            {{ $activityLog->created_at?->format('d M Y, h:i:s A') ?? '-' }}
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <strong>User Agent</strong>

                        <div class="border rounded p-3 mt-1 bg-light text-break">
                            {{ $activityLog->user_agent ?? '-' }}
                        </div>
                    </div>

                </div>

            </div>

            <hr>

            {{-- Delete --}}
            <div>

                <form
                    action="{{ route('activity-logs.destroy', $activityLog) }}"
                    method="POST"
                    class="delete-form"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete Activity Log
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection

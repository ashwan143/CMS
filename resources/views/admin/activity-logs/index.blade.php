@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Activity Logs</h1>
            <p class="text-muted mb-0">Track administrator activity across the CMS.</p>
        </div>
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

    {{-- Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('activity-logs.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search action, module, description, IP, user name or email..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>

                    <div class="col-md-2">
                        <button
                            type="submit"
                            class="btn btn-secondary w-100">
                            Search
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Activity Logs Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Module</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th width="160">Date</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($logs as $log)

                            <tr>

                                <td>
                                    {{ $logs->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if($log->user)
                                        <strong>{{ $log->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $log->user->email }}
                                        </small>
                                    @else
                                        <span class="text-muted">
                                            System / Deleted User
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $log->action }}
                                    </span>
                                </td>

                                <td>
                                    {{ $log->module ?? '-' }}
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit(
                                        $log->description ?? '-',
                                        80
                                    ) }}
                                </td>

                                <td>
                                    {{ $log->ip_address ?? '-' }}
                                </td>

                                <td>
                                    {{ $log->created_at?->format('d M Y, h:i A') ?? '-' }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('activity-logs.show', $log) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        View
                                    </a>

                                    <form
                                        action="{{ route('activity-logs.destroy', $log) }}"
                                        method="POST"
                                        class="d-inline delete-form"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <span class="text-muted">
                                        No activity logs found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($logs->hasPages())
                <div class="mt-3">
                    {{ $logs->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

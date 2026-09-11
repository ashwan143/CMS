@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Newsletter Subscribers</h1>
            <p class="text-muted mb-0">Manage your newsletter subscribers.</p>
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

            <form method="GET" action="{{ route('newsletter-subscribers.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name or email..."
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

    {{-- Subscribers Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="110">Status</th>
                            <th width="180">Subscribed At</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($subscribers as $subscriber)

                            <tr>

                                <td>
                                    {{ $subscribers->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $subscriber->name ?? '-' }}
                                </td>

                                <td>
                                    <a href="mailto:{{ $subscriber->email }}">
                                        {{ $subscriber->email }}
                                    </a>
                                </td>

                                <td>

                                    @if($subscriber->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $subscriber->subscribed_at?->format('d M Y, h:i A') ?? '-' }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('newsletter-subscribers.show', $subscriber) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            View
                                        </a>

                                        <form
                                            action="{{ route('newsletter-subscribers.update-status', $subscriber) }}"
                                            method="POST"
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="{{ $subscriber->status ? 0 : 1 }}"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-sm {{ $subscriber->status ? 'btn-warning' : 'btn-success' }}"
                                            >
                                                {{ $subscriber->status ? 'Disable' : 'Enable' }}
                                            </button>

                                        </form>

                                        <form
                                            action="{{ route('newsletter-subscribers.destroy', $subscriber) }}"
                                            method="POST"
                                            class="d-inline delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Delete"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <span class="text-muted">
                                        No newsletter subscribers found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($subscribers->hasPages())
                <div class="mt-3">
                    {{ $subscribers->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

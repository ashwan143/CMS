@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Contact Messages</h1>
            <p class="text-muted mb-0">Manage messages received from website visitors.</p>
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

            <form method="GET" action="{{ route('contact-messages.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name, email or subject..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">
                            Search
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Messages Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th width="100">Status</th>
                            <th width="160">Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($messages as $message)

                            <tr class="{{ !$message->is_read ? 'fw-bold' : '' }}">

                                <td>
                                    {{ $messages->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $message->name }}
                                </td>

                                <td>
                                    <a href="mailto:{{ $message->email }}">
                                        {{ $message->email }}
                                    </a>
                                </td>

                                <td>
                                    {{ $message->subject ?? '-' }}
                                </td>

                                <td>

                                    @if($message->is_read)

                                        <span class="badge bg-success">
                                            Read
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Unread
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $message->created_at->format('d M Y, h:i A') }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('contact-messages.show', $message) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            View
                                        </a>

                                        @if(!$message->is_read)

                                            <form
                                                action="{{ route('contact-messages.mark-read', $message) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-success"
                                                    title="Mark as Read"
                                                >
                                                    Read
                                                </button>
                                            </form>

                                        @else

                                            <form
                                                action="{{ route('contact-messages.mark-unread', $message) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-secondary"
                                                    title="Mark as Unread"
                                                >
                                                    Unread
                                                </button>
                                            </form>

                                        @endif

                                        <form
                                            action="{{ route('contact-messages.destroy', $message) }}"
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
                                <td colspan="7" class="text-center py-4">
                                    <span class="text-muted">
                                        No contact messages found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($messages->hasPages())
                <div class="mt-3">
                    {{ $messages->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

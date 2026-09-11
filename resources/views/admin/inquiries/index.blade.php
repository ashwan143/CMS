@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Inquiries</h1>
            <p class="text-muted mb-0">Manage customer inquiries and leads.</p>
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

            <form method="GET" action="{{ route('inquiries.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name, email, phone, subject or type..."
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

    {{-- Inquiries Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th width="120">Status</th>
                            <th>Assigned To</th>
                            <th width="150">Date</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inquiries as $inquiry)

                            @php
                                $statusLabels = [
                                    0 => ['label' => 'New', 'class' => 'bg-primary'],
                                    1 => ['label' => 'In Progress', 'class' => 'bg-warning text-dark'],
                                    2 => ['label' => 'Resolved', 'class' => 'bg-success'],
                                    3 => ['label' => 'Closed', 'class' => 'bg-secondary'],
                                ];

                                $currentStatus = $statusLabels[$inquiry->status] ?? [
                                    'label' => 'Unknown',
                                    'class' => 'bg-dark'
                                ];
                            @endphp

                            <tr>

                                <td>
                                    {{ $inquiries->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $inquiry->name }}</strong>
                                </td>

                                <td>
                                    @if($inquiry->email)
                                        <a href="mailto:{{ $inquiry->email }}">
                                            {{ $inquiry->email }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if($inquiry->phone)
                                        <a href="tel:{{ $inquiry->phone }}">
                                            {{ $inquiry->phone }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    {{ $inquiry->subject ?? '-' }}
                                </td>

                                <td>
                                    {{ $inquiry->type ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge {{ $currentStatus['class'] }}">
                                        {{ $currentStatus['label'] }}
                                    </span>
                                </td>

                                <td>
                                    {{ $inquiry->assignedUser?->name ?? 'Unassigned' }}
                                </td>

                                <td>
                                    {{ $inquiry->created_at?->format('d M Y, h:i A') ?? '-' }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('inquiries.show', $inquiry) }}"
                                        class="btn btn-sm btn-info text-white"
                                    >
                                        View
                                    </a>

                                    <form
                                        action="{{ route('inquiries.destroy', $inquiry) }}"
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
                                <td colspan="10" class="text-center py-4">
                                    <span class="text-muted">
                                        No inquiries found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($inquiries->hasPages())
                <div class="mt-3">
                    {{ $inquiries->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

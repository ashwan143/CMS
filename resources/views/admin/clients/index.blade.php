@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Clients</h1>
            <p class="text-muted mb-0">Manage your clients and companies.</p>
        </div>

        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Client
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('clients.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search clients..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Clients Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th width="60">#</th>
                            <th width="100">Logo</th>
                            <th>Name</th>
                            <th>Industry</th>
                            <th>Website</th>
                            <th width="100">Order</th>
                            <th width="100">Status</th>
                            <th width="110">Featured</th>
                            <th width="180">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($clients as $client)

                            <tr>

                                <td>
                                    {{ $clients->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if($client->logo)
                                        <img
                                            src="{{ asset('storage/' . $client->logo) }}"
                                            alt="{{ $client->name }}"
                                            width="60"
                                            height="60"
                                            class="rounded border"
                                            style="object-fit: contain;"
                                        >
                                    @else
                                        <span class="text-muted">No Logo</span>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $client->name }}</strong>
                                </td>

                                <td>
                                    {{ $client->industry ?? '-' }}
                                </td>

                                <td>
                                    @if($client->website)
                                        <a
                                            href="{{ $client->website }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Visit Website
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $client->order }}
                                </td>

                                <td>

                                    @if($client->status)
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

                                    @if($client->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            Featured
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            No
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('clients.show', $client) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a
                                            href="{{ route('clients.edit', $client) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('clients.destroy', $client) }}"
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
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <span class="text-muted">
                                        No clients found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($clients->hasPages())
                <div class="mt-3">
                    {{ $clients->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

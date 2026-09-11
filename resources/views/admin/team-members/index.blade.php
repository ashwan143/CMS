@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Team Members</h1>
            <p class="text-muted mb-0">Manage your team members.</p>
        </div>

        <a href="{{ route('team-members.create') }}" class="btn btn-primary">
            Add Team Member
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

            <form method="GET" action="{{ route('team-members.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by name or designation..."
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

    {{-- Team Members Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th width="100">Photo</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th width="100">Order</th>
                            <th width="100">Status</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($teamMembers as $teamMember)

                            <tr>

                                <td>
                                    {{ $teamMembers->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if($teamMember->profile_image)

                                        <img
                                            src="{{ asset('storage/' . $teamMember->profile_image) }}"
                                            alt="{{ $teamMember->name }}"
                                            width="60"
                                            height="60"
                                            class="rounded border"
                                            style="object-fit: cover;"
                                        >

                                    @else

                                        <span class="text-muted">
                                            No Photo
                                        </span>

                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $teamMember->name }}</strong>
                                </td>

                                <td>
                                    {{ $teamMember->designation ?? '-' }}
                                </td>

                                <td>
                                    {{ $teamMember->order }}
                                </td>

                                <td>

                                    @if($teamMember->status)

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

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('team-members.show', $teamMember) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('team-members.edit', $teamMember) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('team-members.destroy', $teamMember) }}"
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
                                        No team members found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($teamMembers->hasPages())
                <div class="mt-3">
                    {{ $teamMembers->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

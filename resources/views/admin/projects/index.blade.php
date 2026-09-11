@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Projects</h2>

            <p class="text-muted mb-0">
                Manage your company projects and portfolio.
            </p>
        </div>

        <a href="{{ route('projects.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Project

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Search & Filter --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('projects.index') }}">

                <div class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Search Projects
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search by project, client or category..."
                        >

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="">
                                All Status
                            </option>

                            <option value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Filter Buttons --}}
                    <div class="col-md-3 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bi bi-search"></i>
                            Search

                        </button>

                        <a href="{{ route('projects.index') }}"
                           class="btn btn-outline-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Projects Table --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    All Projects
                </h5>

                <span class="badge bg-primary">

                    {{ $projects->total() }}

                    Projects

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                #
                            </th>

                            <th width="100">
                                Image
                            </th>

                            <th>
                                Project
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Client
                            </th>

                            <th>
                                Completion
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="160">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($projects as $project)

                            <tr>

                                {{-- Number --}}
                                <td>

                                    {{ $projects->firstItem() + $loop->index }}

                                </td>


                                {{-- Image --}}
                                <td>

                                    @if($project->image)

                                        <img
                                            src="{{ asset('storage/' . $project->image) }}"
                                            alt="{{ $project->title }}"
                                            width="70"
                                            height="50"
                                            class="rounded object-fit-cover"
                                        >

                                    @else

                                        <div
                                            class="bg-light border rounded d-flex align-items-center justify-content-center"
                                            style="width:70px;height:50px;"
                                        >

                                            <i class="bi bi-image text-muted"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- Project --}}
                                <td>

                                    <div class="fw-semibold">

                                        {{ $project->title }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $project->slug }}

                                    </small>

                                </td>


                                {{-- Category --}}
                                <td>

                                    @if($project->category)

                                        <span class="badge bg-light text-dark border">

                                            {{ $project->category }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Client --}}
                                <td>

                                    {{ $project->client_name ?? '—' }}

                                </td>


                                {{-- Completion Date --}}
                                <td>

                                    @if($project->completion_date)

                                        {{ \Carbon\Carbon::parse($project->completion_date)->format('d M Y') }}

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($project->status)

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('projects.show', $project) }}"
                                            class="btn btn-sm btn-outline-info"
                                            title="View"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('projects.edit', $project) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form
    action="{{ route('projects.destroy', $project) }}"
    method="POST"
    class="delete-project-form d-inline"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-sm btn-outline-danger"
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

                                <td colspan="8"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-folder2-open fs-1"></i>

                                        <h5 class="mt-3">
                                            No Projects Found
                                        </h5>

                                        <p class="mb-3">
                                            You haven't created any projects yet.
                                        </p>

                                        <a
                                            href="{{ route('projects.create') }}"
                                            class="btn btn-primary"
                                        >

                                            <i class="bi bi-plus-lg"></i>
                                            Add Your First Project

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        @if($projects->hasPages())

            <div class="card-footer bg-white">

                {{ $projects->links() }}

            </div>

        @endif

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-project-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "This project and its technology relationships will be deleted.",
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'

            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>

@endsection

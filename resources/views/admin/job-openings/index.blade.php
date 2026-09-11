@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Job Openings</h1>
            <p class="text-muted mb-0">Manage your company's job openings.</p>
        </div>

        <a href="{{ route('job-openings.create') }}" class="btn btn-primary">
            Add Job Opening
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

    {{-- Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('job-openings.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by title, department, location or employment type..."
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

    {{-- Job Openings Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>Job Title</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Employment Type</th>
                            <th width="100">Deadline</th>
                            <th width="90">Order</th>
                            <th width="100">Status</th>
                            <th width="110">Featured</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($jobOpenings as $jobOpening)

                            <tr>

                                <td>
                                    {{ $jobOpenings->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $jobOpening->title }}</strong>

                                    @if($jobOpening->short_description)
                                        <br>
                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($jobOpening->short_description, 80) }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    {{ $jobOpening->department ?? '-' }}
                                </td>

                                <td>
                                    {{ $jobOpening->location ?? '-' }}
                                </td>

                                <td>
                                    {{ $jobOpening->employment_type ?? '-' }}
                                </td>

                                <td>
                                    @if($jobOpening->deadline)
                                        {{ $jobOpening->deadline->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    {{ $jobOpening->order }}
                                </td>

                                <td>
                                    @if($jobOpening->status)
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
                                    @if($jobOpening->is_featured)
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
                                            href="{{ route('job-openings.show', $jobOpening) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('job-openings.edit', $jobOpening) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('job-openings.destroy', $jobOpening) }}"
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
                                <td colspan="10" class="text-center py-4">
                                    <span class="text-muted">
                                        No job openings found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($jobOpenings->hasPages())
                <div class="mt-3">
                    {{ $jobOpenings->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

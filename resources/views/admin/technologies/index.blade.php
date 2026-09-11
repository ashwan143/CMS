@extends('admin.layouts.app')

@section('title', 'Technologies')

@section('content')

<div class="container-fluid">

    {{-- ================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ================================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Technologies</h2>

            <p class="text-muted mb-0">
                Manage technologies used in your company projects.
            </p>
        </div>

        <a href="{{ route('technologies.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Technology

        </a>

    </div>


    {{-- ================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ================================================= --}}

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


    {{-- ================================================= --}}
    {{-- SEARCH + FILTER --}}
    {{-- ================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('technologies.index') }}">

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-md-6">

                        <label for="search"
                               class="form-label">

                            Search Technology

                        </label>

                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search by name or slug..."
                        >

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3">

                        <label for="status"
                               class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select"
                        >

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


                    {{-- Buttons --}}
                    <div class="col-md-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-search"></i>
                                Search

                            </button>

                            <a
                                href="{{ route('technologies.index') }}"
                                class="btn btn-outline-secondary"
                            >

                                <i class="bi bi-arrow-clockwise"></i>
                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- TECHNOLOGIES TABLE --}}
    {{-- ================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Technology List
            </h5>

            <span class="text-muted">

                {{ $technologies->total() }}
                {{ Str::plural('Technology', $technologies->total()) }}

            </span>

        </div>


        <div class="card-body p-0">

            @if($technologies->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="70">
                                    #
                                </th>

                                <th width="90">
                                    Icon
                                </th>

                                <th>
                                    Technology
                                </th>

                                <th>
                                    Slug
                                </th>

                                <th width="120">
                                    Order
                                </th>

                                <th width="120">
                                    Status
                                </th>

                                <th width="180"
                                    class="text-end">

                                    Actions

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($technologies as $technology)

                                <tr>

                                    {{-- Number --}}
                                    <td>

                                        {{ $technologies->firstItem() + $loop->index }}

                                    </td>


                                    {{-- Icon --}}
                                    <td>

                                        @if($technology->icon)

                                            <img
                                                src="{{ asset('storage/' . $technology->icon) }}"
                                                alt="{{ $technology->name }}"
                                                width="45"
                                                height="45"
                                                class="rounded object-fit-contain border p-1"
                                            >

                                        @else

                                            <div
                                                class="d-flex align-items-center justify-content-center bg-light border rounded"
                                                style="width:45px;height:45px;"
                                            >

                                                <i class="bi bi-code-slash text-muted"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- Technology --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $technology->name }}

                                        </div>

                                        @if($technology->description)

                                            <small class="text-muted">

                                                {{ Str::limit($technology->description, 60) }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- Slug --}}
                                    <td>

                                        <code>
                                            {{ $technology->slug }}
                                        </code>

                                    </td>


                                    {{-- Order --}}
                                    <td>

                                        {{ $technology->order }}

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($technology->status)

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

                                        <div class="d-flex justify-content-end gap-1">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('technologies.show', $technology) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('technologies.edit', $technology) }}"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Edit"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- Delete --}}
                                          {{-- Delete Technology --}}
<form
    action="{{ route('technologies.destroy', $technology) }}"
    method="POST"
    class="delete-technology-form d-inline"
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

                            @endforeach

                        </tbody>

                    </table>

                </div>


            @else

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <div class="mb-3">

                        <i
                            class="bi bi-code-square text-muted"
                            style="font-size: 3rem;"
                        ></i>

                    </div>

                    <h5>
                        No Technologies Found
                    </h5>

                    <p class="text-muted mb-3">

                        Start by adding the first technology.

                    </p>

                    <a
                        href="{{ route('technologies.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Add Technology

                    </a>

                </div>

            @endif

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($technologies->hasPages())

            <div class="card-footer bg-white">

                {{ $technologies->links() }}

            </div>

        @endif

    </div>

</div>
{{-- Project table --}}


{<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-project-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#d33',
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





@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Pages</h4>

            <p class="text-muted mb-0">
                Manage your website pages
            </p>
        </div>

        <a href="{{ route('pages.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-1"></i>

            Add Page

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Search & Filter --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('pages.index') }}">

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Search by title or slug..."
                                   value="{{ request('search') }}">

                        </div>

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


                    {{-- Buttons --}}
                    <div class="col-md-3">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a href="{{ route('pages.index') }}"
                               class="btn btn-light border">

                                <i class="bi bi-arrow-counterclockwise me-1"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Pages Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            @if($pages->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="70">
                                    #
                                </th>

                                <th width="90">
                                    Image
                                </th>

                                <th>
                                    Page
                                </th>

                                <th>
                                    Template
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Order
                                </th>

                                <th>
                                    Created
                                </th>

                                <th class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($pages as $page)

                                <tr>

                                    {{-- Number --}}
                                    <td>

                                        {{ $pages->firstItem() + $loop->index }}

                                    </td>


                                    {{-- Image --}}
                                    <td>

                                        @if($page->featured_image)

                                            <img src="{{ asset('storage/' . $page->featured_image) }}"
                                                 alt="{{ $page->title }}"
                                                 width="55"
                                                 height="45"
                                                 class="rounded object-fit-cover">

                                        @else

                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                 style="width:55px;height:45px;">

                                                <i class="bi bi-file-earmark-text text-muted"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- Page --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $page->title }}
                                        </div>

                                        <small class="text-muted">

                                            /{{ $page->slug }}

                                        </small>

                                    </td>


                                    {{-- Template --}}
                                    <td>

                                        <span class="badge bg-light text-dark border">

                                            {{ ucfirst($page->template) }}

                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($page->status)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Display Order --}}
                                    <td>

                                        {{ $page->display_order }}

                                    </td>


                                    {{-- Created --}}
                                    <td>

                                        <div>
                                            {{ $page->created_at->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $page->created_at->format('h:i A') }}
                                        </small>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="text-end">

                                        <div class="btn-group">

                                            {{-- View --}}
                                            <a href="{{ route('pages.show', $page) }}"
                                               class="btn btn-sm btn-outline-info"
                                               title="View">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- Edit --}}
                                            <a href="{{ route('pages.edit', $page) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('pages.destroy', $page) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this page?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Delete">

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


                {{-- Pagination --}}
                @if($pages->hasPages())

                    <div class="card-footer bg-white border-0">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <div class="text-muted small">

                                Showing
                                <strong>{{ $pages->firstItem() }}</strong>
                                to
                                <strong>{{ $pages->lastItem() }}</strong>
                                of
                                <strong>{{ $pages->total() }}</strong>
                                pages

                            </div>

                            <div>

                                {{ $pages->links() }}

                            </div>

                        </div>

                    </div>

                @endif


            @else

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <div class="mb-3">

                        <i class="bi bi-file-earmark-text display-4 text-muted"></i>

                    </div>

                    <h5>
                        No Pages Found
                    </h5>

                    <p class="text-muted mb-4">

                        @if(request()->filled('search') || request()->filled('status'))

                            No pages match your current filters.

                        @else

                            You haven't created any pages yet.

                        @endif

                    </p>


                    @if(request()->filled('search') || request()->filled('status'))

                        <a href="{{ route('pages.index') }}"
                           class="btn btn-light border me-2">

                            Reset Filters

                        </a>

                    @endif


                    <a href="{{ route('pages.create') }}"
                       class="btn btn-primary">

                        <i class="bi bi-plus-lg me-1"></i>

                        Create First Page

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-page-btn').forEach(function (button) {

        button.addEventListener('click', function () {

            const form = this.closest('.delete-page-form');

            Swal.fire({

                title: 'Delete this page?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel',

                reverseButtons: true

            }).then(function (result) {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

});
</script>

@endsection

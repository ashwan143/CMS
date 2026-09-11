@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-journal-text me-2"></i>
                Blogs
            </h4>

            <p class="text-muted mb-0">
                Manage company blogs, articles, categories and tags.
            </p>
        </div>

        <div>
            <a
                href="{{ route('blogs.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Add Blog
            </a>
        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        SEARCH & FILTER
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('blogs.index') }}"
            >

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-5">

                        <label class="form-label">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Search by title, slug or description..."
                            >

                        </div>

                    </div>


                    {{-- Category --}}
                    <div class="col-lg-3">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                        >

                            <option value="">
                                All Categories
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        request('category_id') == $category->id
                                    )
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Status --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="1"
                                @selected(request('status') === '1')
                            >
                                Published
                            </option>

                            <option
                                value="0"
                                @selected(request('status') === '0')
                            >
                                Draft
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-lg-2">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                <i class="bi bi-funnel me-1"></i>
                                Filter
                            </button>

                            <a
                                href="{{ route('blogs.index') }}"
                                class="btn btn-outline-secondary"
                                title="Reset"
                            >
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        BLOG TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Blog Articles
                </h5>

                <span class="text-muted small">

                    {{ $blogs->total() }}

                    {{ Str::plural('blog', $blogs->total()) }}

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($blogs->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th style="width:70px;">
                                    Image
                                </th>

                                <th>
                                    Blog
                                </th>

                                <th>
                                    Category
                                </th>

                                <th>
                                    Author
                                </th>

                                <th>
                                    Tags
                                </th>

                                <th>
                                    Published
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Order
                                </th>

                                <th
                                    class="text-end"
                                    style="width:150px;"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($blogs as $blog)

                                <tr>

                                    {{-- =================================================
                                        IMAGE
                                    ================================================== --}}
                                    <td>

                                        @if($blog->featured_image)

                                            <img
                                                src="{{ asset('storage/' . $blog->featured_image) }}"
                                                alt="{{ $blog->title }}"
                                                class="rounded border"
                                                width="55"
                                                height="40"
                                                style="object-fit:cover;"
                                            >

                                        @else

                                            <div
                                                class="bg-light border rounded d-flex align-items-center justify-content-center"
                                                style="
                                                    width:55px;
                                                    height:40px;
                                                "
                                            >

                                                <i class="bi bi-image text-muted"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        BLOG
                                    ================================================== --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ Str::limit($blog->title, 55) }}

                                        </div>

                                        <div class="text-muted small">

                                            /{{ $blog->slug }}

                                        </div>

                                    </td>


                                    {{-- =================================================
                                        CATEGORY
                                    ================================================== --}}
                                    <td>

                                        @if($blog->category)

                                            <span class="badge bg-light text-dark border">

                                                {{ $blog->category->name }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        AUTHOR
                                    ================================================== --}}
                                    <td>

                                        {{ $blog->author->name ?? '—' }}

                                    </td>


                                    {{-- =================================================
                                        TAGS
                                    ================================================== --}}
                                    <td>

                                        @if($blog->tags->count())

                                            <div class="d-flex flex-wrap gap-1">

                                                @foreach(
                                                    $blog->tags->take(3)
                                                    as $tag
                                                )

                                                    <span class="badge bg-secondary">

                                                        {{ $tag->name }}

                                                    </span>

                                                @endforeach


                                                @if($blog->tags->count() > 3)

                                                    <span class="badge bg-light text-dark border">

                                                        +{{ $blog->tags->count() - 3 }}

                                                    </span>

                                                @endif

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        PUBLISHED DATE
                                    ================================================== --}}
                                    <td>

                                        @if($blog->published_at)

                                            <div>
                                                {{ $blog->published_at->format('d M Y') }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $blog->published_at->format('h:i A') }}
                                            </small>

                                        @else

                                            <span class="text-muted">
                                                Not published
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        STATUS
                                    ================================================== --}}
                                    <td>

                                        @if($blog->status)

                                            <span class="badge bg-success">
                                                Published
                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                Draft
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        ORDER
                                    ================================================== --}}
                                    <td>

                                        <span class="badge bg-dark">

                                            {{ $blog->order }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                        ACTIONS
                                    ================================================== --}}
                                    <td>

                                        <div class="d-flex justify-content-end gap-1">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('blogs.show', $blog) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('blogs.edit', $blog) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('blogs.destroy', $blog) }}"
                                                method="POST"
                                                class="d-inline delete-blog-form"
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

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}
                <div class="text-center py-5">

                    <i
                        class="bi bi-journal-x text-muted"
                        style="font-size:4rem;"
                    ></i>

                    <h5 class="mt-3">
                        No Blogs Found
                    </h5>

                    <p class="text-muted">

                        No blog articles match your current filters.

                    </p>

                    <a
                        href="{{ route('blogs.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Create First Blog
                    </a>

                </div>

            @endif

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}
        @if($blogs->hasPages())

            <div class="card-footer bg-white">

                {{ $blogs->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

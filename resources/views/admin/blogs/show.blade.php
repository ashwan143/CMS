@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2">

                <a
                    href="{{ route('blogs.index') }}"
                    class="btn btn-sm btn-outline-secondary"
                    title="Back"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div>

                    <h4 class="mb-1">
                        <i class="bi bi-journal-text me-2"></i>
                        Blog Details
                    </h4>

                    <p class="text-muted mb-0">
                        View complete blog information.
                    </p>

                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="d-flex gap-2">

            <a
                href="{{ route('blogs.edit', $blog) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit Blog
            </a>

        </div>

    </div>


    {{-- =========================================================
        MAIN BLOG INFORMATION
    ========================================================== --}}
    <div class="row g-4">

        {{-- =====================================================
            LEFT COLUMN
        ====================================================== --}}
        <div class="col-lg-8">

            {{-- Blog Content Card --}}
            <div class="card border-0 shadow-sm mb-4">

                {{-- Featured Image --}}
                @if($blog->featured_image)

                    <img
                        src="{{ asset('storage/' . $blog->featured_image) }}"
                        alt="{{ $blog->title }}"
                        class="card-img-top"
                        style="
                            max-height:420px;
                            object-fit:cover;
                        "
                    >

                @endif


                <div class="card-body">

                    {{-- Title --}}
                    <h2 class="mb-3">

                        {{ $blog->title }}

                    </h2>


                    {{-- Meta Information --}}
                    <div class="d-flex flex-wrap gap-2 mb-4">

                        {{-- Category --}}
                        @if($blog->category)

                            <span class="badge bg-primary">

                                <i class="bi bi-folder me-1"></i>

                                {{ $blog->category->name }}

                            </span>

                        @endif


                        {{-- Status --}}
                        @if($blog->status)

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Published

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                <i class="bi bi-pencil-square me-1"></i>

                                Draft

                            </span>

                        @endif


                        {{-- Author --}}
                        @if($blog->author)

                            <span class="badge bg-light text-dark border">

                                <i class="bi bi-person me-1"></i>

                                {{ $blog->author->name }}

                            </span>

                        @endif


                        {{-- Published Date --}}
                        @if($blog->published_at)

                            <span class="badge bg-light text-dark border">

                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $blog->published_at->format('d M Y, h:i A') }}

                            </span>

                        @endif

                    </div>


                    {{-- Short Description --}}
                    @if($blog->short_description)

                        <div class="alert alert-light border mb-4">

                            <div class="fw-semibold mb-1">
                                Short Description
                            </div>

                            <div class="text-muted">

                                {{ $blog->short_description }}

                            </div>

                        </div>

                    @endif


                    {{-- Blog Content --}}
                    <div class="blog-content">

                        {!! $blog->content !!}

                    </div>

                </div>

            </div>


            {{-- =================================================
                TAGS
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-tags me-2"></i>

                        Tags

                    </h6>

                </div>


                <div class="card-body">

                    @if($blog->tags->count())

                        <div class="d-flex flex-wrap gap-2">

                            @foreach($blog->tags as $tag)

                                <span class="badge bg-secondary">

                                    <i class="bi bi-tag me-1"></i>

                                    {{ $tag->name }}

                                </span>

                            @endforeach

                        </div>

                    @else

                        <span class="text-muted">
                            No tags assigned.
                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                SEO INFORMATION
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-search me-2"></i>

                        SEO Information

                    </h6>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="form-label text-muted">
                                SEO Title
                            </label>

                            <div class="fw-semibold">

                                {{ $blog->seo_title ?: 'Not configured' }}

                            </div>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label text-muted">
                                SEO Description
                            </label>

                            <div>

                                {{ $blog->seo_description ?: 'Not configured' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT COLUMN
        ====================================================== --}}
        <div class="col-lg-4">

            {{-- Blog Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Blog Information

                    </h6>

                </div>


                <div class="card-body">

                    {{-- ID --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Blog ID
                        </small>

                        <strong>
                            #{{ $blog->id }}
                        </strong>

                    </div>


                    {{-- Slug --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Slug
                        </small>

                        <code>
                            {{ $blog->slug }}
                        </code>

                    </div>


                    {{-- Category --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Category
                        </small>

                        @if($blog->category)

                            <span class="badge bg-primary">

                                {{ $blog->category->name }}

                            </span>

                        @else

                            <span class="text-muted">
                                No category
                            </span>

                        @endif

                    </div>


                    {{-- Author --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Author
                        </small>

                        <strong>

                            {{ $blog->author->name ?? 'Unknown' }}

                        </strong>

                    </div>


                    {{-- Status --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Status
                        </small>

                        @if($blog->status)

                            <span class="badge bg-success">
                                Published
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                Draft
                            </span>

                        @endif

                    </div>


                    {{-- Published --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Published At
                        </small>

                        @if($blog->published_at)

                            {{ $blog->published_at->format('d M Y, h:i A') }}

                        @else

                            <span class="text-muted">
                                Not published
                            </span>

                        @endif

                    </div>


                    {{-- Display Order --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Display Order
                        </small>

                        <span class="badge bg-dark">

                            {{ $blog->order }}

                        </span>

                    </div>


                    {{-- Created --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created
                        </small>

                        {{ $blog->created_at->format('d M Y, h:i A') }}

                    </div>


                    {{-- Updated --}}
                    <div>

                        <small class="text-muted d-block">
                            Last Updated
                        </small>

                        {{ $blog->updated_at->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>


            {{-- =================================================
                DELETE
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h6 class="mb-0 text-danger">

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        Danger Zone

                    </h6>

                </div>


                <div class="card-body">

                    <p class="text-muted small">

                        Deleting this blog will also remove its
                        associated tag relationships and featured
                        image.

                    </p>


                    <form
                        action="{{ route('blogs.destroy', $blog) }}"
                        method="POST"
                        class="delete-blog-form"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger w-100"
                        >

                            <i class="bi bi-trash me-1"></i>

                            Delete Blog

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

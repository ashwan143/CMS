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
                    href="{{ route('albums.index') }}"
                    class="btn btn-sm btn-outline-secondary"
                    title="Back to Albums"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div>

                    <h4 class="mb-1">

                        <i class="bi bi-images me-2"></i>

                        {{ $album->title }}

                    </h4>

                    <p class="text-muted mb-0">

                        Album details and gallery information.

                    </p>

                </div>

            </div>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('albums.edit', $album) }}"
                class="btn btn-primary"
            >

                <i class="bi bi-pencil me-1"></i>

                Edit Album

            </a>

        </div>

    </div>


    {{-- =========================================================
        ALBUM OVERVIEW
    ========================================================== --}}
    <div class="row g-4">

        {{-- =====================================================
            COVER IMAGE
        ====================================================== --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-image me-2"></i>

                        Album Cover

                    </h6>

                </div>


                <div class="card-body">

                    @if($album->cover_image)

                        <img
                            src="{{ asset('storage/' . $album->cover_image) }}"
                            alt="{{ $album->title }}"
                            class="img-fluid rounded border w-100"
                            style="
                                max-height:300px;
                                object-fit:cover;
                            "
                        >

                    @else

                        <div
                            class="bg-light border rounded d-flex flex-column align-items-center justify-content-center"
                            style="height:300px;"
                        >

                            <i
                                class="bi bi-image text-muted"
                                style="font-size:4rem;"
                            ></i>

                            <span class="text-muted mt-2">
                                No cover image
                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            ALBUM INFORMATION
        ====================================================== --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Album Information

                    </h6>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        {{-- Title --}}
                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Album Title
                            </div>

                            <div class="fw-semibold fs-5">

                                {{ $album->title }}

                            </div>

                        </div>


                        {{-- Slug --}}
                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Slug
                            </div>

                            <code>
                                /{{ $album->slug }}
                            </code>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-4">

                            <div class="text-muted small mb-1">
                                Status
                            </div>

                            @if($album->status)

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Active

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Inactive

                                </span>

                            @endif

                        </div>


                        {{-- Display Order --}}
                        <div class="col-md-4">

                            <div class="text-muted small mb-1">
                                Display Order
                            </div>

                            <span class="badge bg-secondary">

                                {{ $album->order }}

                            </span>

                        </div>


                        {{-- Image Count --}}
                        <div class="col-md-4">

                            <div class="text-muted small mb-1">
                                Gallery Images
                            </div>

                            <span class="badge bg-info text-dark">

                                <i class="bi bi-images me-1"></i>

                                {{ $album->gallery_images_count }}

                            </span>

                        </div>


                        {{-- Description --}}
                        <div class="col-12">

                            <div class="text-muted small mb-1">
                                Description
                            </div>

                            @if($album->description)

                                <div class="text-muted">

                                    {!! nl2br(e($album->description)) !!}

                                </div>

                            @else

                                <span class="text-muted">
                                    No description provided.
                                </span>

                            @endif

                        </div>


                        {{-- Created By --}}
                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Created By
                            </div>

                            <div>

                                <i class="bi bi-person me-1"></i>

                                {{ $album->createdBy?->name ?? 'System' }}

                            </div>

                        </div>


                        {{-- Created Date --}}
                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                Created At
                            </div>

                            <div>

                                {{ $album->created_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        GALLERY SECTION
    ========================================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>

                <h6 class="mb-1">

                    <i class="bi bi-grid-3x3-gap me-2"></i>

                    Gallery Images

                </h6>

                <small class="text-muted">

                    Images belonging to this album.

                </small>

            </div>


            {{-- Future Gallery Image Route --}}
            <span class="badge bg-secondary">

                {{ $album->gallery_images_count }} Images

            </span>

        </div>


        <div class="card-body">

            @if($album->galleryImages->count())

                <div class="row g-3">

                    @foreach($album->galleryImages as $image)

                        <div class="col-6 col-md-4 col-lg-3">

                            <div class="card border h-100">

                                <img
                                    src="{{ asset('storage/' . $image->image) }}"
                                    alt="{{ $image->alt_text ?? $image->title ?? $album->title }}"
                                    class="card-img-top"
                                    style="
                                        height:180px;
                                        object-fit:cover;
                                    "
                                >

                                <div class="card-body p-2">

                                    <div class="fw-semibold small">

                                        {{ $image->title ?? 'Untitled Image' }}

                                    </div>

                                    <div class="text-muted small">

                                        Order: {{ $image->order }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="text-center py-5">

                    <i
                        class="bi bi-images text-muted"
                        style="font-size:3rem;"
                    ></i>

                    <h6 class="mt-3 mb-1">
                        No gallery images
                    </h6>

                    <p class="text-muted mb-0">
                        Images for this album will appear here.
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
        ACTIONS
    ========================================================== --}}
    <div class="d-flex justify-content-between align-items-center mt-4">

        <a
            href="{{ route('albums.index') }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Back to Albums

        </a>


        <div class="d-flex gap-2">

            <a
                href="{{ route('albums.edit', $album) }}"
                class="btn btn-primary"
            >

                <i class="bi bi-pencil me-1"></i>

                Edit Album

            </a>

        </div>

    </div>

</div>

@endsection

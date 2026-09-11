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
                    href="{{ route('gallery-images.index') }}"
                    class="btn btn-sm btn-outline-secondary"
                    title="Back"
                >

                    <i class="bi bi-arrow-left"></i>

                </a>

                <div>

                    <h4 class="mb-1">

                        <i class="bi bi-eye me-2"></i>

                        Gallery Image Details

                    </h4>

                    <p class="text-muted mb-0">

                        View gallery image information.

                    </p>

                </div>

            </div>

        </div>


        <div>

            <a
                href="{{ route('gallery-images.edit', $galleryImage) }}"
                class="btn btn-primary"
            >

                <i class="bi bi-pencil me-1"></i>

                Edit Image

            </a>

        </div>

    </div>


    {{-- =========================================================
        IMAGE + DETAILS
    ========================================================== --}}
    <div class="row g-4">

        {{-- =====================================================
            IMAGE PREVIEW
        ====================================================== --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-image me-2"></i>

                        Image Preview

                    </h6>

                </div>

                <div class="card-body text-center">

                    @if($galleryImage->image)

                        <img
                            src="{{ asset('storage/' . $galleryImage->image) }}"
                            alt="{{ $galleryImage->alt_text ?? $galleryImage->title ?? 'Gallery Image' }}"
                            class="img-fluid rounded shadow-sm"
                            style="
                                max-height:600px;
                                object-fit:contain;
                            "
                        >

                    @else

                        <div class="py-5 text-muted">

                            <i
                                class="bi bi-image"
                                style="font-size:5rem;"
                            ></i>

                            <p class="mt-3 mb-0">
                                No image available.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            DETAILS
        ====================================================== --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-info-circle me-2"></i>

                        Image Information

                    </h6>

                </div>

                <div class="card-body">

                    {{-- Title --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Image Title
                        </small>

                        <div class="fw-semibold">

                            {{ $galleryImage->title ?? 'Untitled Image' }}

                        </div>

                    </div>


                    {{-- Album --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Album
                        </small>

                        @if($galleryImage->album)

                            <a
                                href="{{ route('albums.show', $galleryImage->album) }}"
                                class="text-decoration-none"
                            >

                                <i class="bi bi-folder me-1"></i>

                                {{ $galleryImage->album->title }}

                            </a>

                        @else

                            <span class="text-muted">
                                No Album
                            </span>

                        @endif

                    </div>


                    {{-- ALT Text --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            SEO ALT Text
                        </small>

                        <div>

                            {{ $galleryImage->alt_text ?? 'Not provided' }}

                        </div>

                    </div>


                    {{-- Display Order --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Display Order
                        </small>

                        <span class="badge bg-secondary">

                            {{ $galleryImage->order }}

                        </span>

                    </div>


                    {{-- Status --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Status
                        </small>

                        @if($galleryImage->status)

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


                    {{-- File Path --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            File Path
                        </small>

                        <code class="small">

                            {{ $galleryImage->image }}

                        </code>

                    </div>


                    {{-- Created --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Created
                        </small>

                        <div>

                            {{ $galleryImage->created_at?->format('d M Y, h:i A') }}

                        </div>

                    </div>


                    {{-- Updated --}}
                    <div>

                        <small class="text-muted d-block mb-1">
                            Last Updated
                        </small>

                        <div>

                            {{ $galleryImage->updated_at?->format('d M Y, h:i A') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        BOTTOM ACTIONS
    ========================================================== --}}
    <div class="d-flex justify-content-between align-items-center mt-4">

        <a
            href="{{ route('gallery-images.index') }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Back to Gallery

        </a>


        <a
            href="{{ route('gallery-images.edit', $galleryImage) }}"
            class="btn btn-primary"
        >

            <i class="bi bi-pencil me-1"></i>

            Edit Image

        </a>

    </div>

</div>

@endsection

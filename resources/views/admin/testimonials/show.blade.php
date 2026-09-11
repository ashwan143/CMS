@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <i class="bi bi-chat-square-quote me-2"></i>
                Testimonial Details
            </h4>

            <p class="text-muted mb-0">
                View complete client testimonial information.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('testimonials.edit', $testimonial) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('testimonials.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    {{-- =========================================================
        TESTIMONIAL PROFILE CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                {{-- Client Photo --}}
                <div class="col-md-2 text-center">

                    @if($testimonial->client_photo)

                        <img
                            src="{{ asset('storage/' . $testimonial->client_photo) }}"
                            alt="{{ $testimonial->photo_alt ?? $testimonial->client_name }}"
                            class="rounded-circle border"
                            width="130"
                            height="130"
                            style="object-fit:cover;"
                        >

                    @else

                        <div
                            class="rounded-circle bg-light border mx-auto d-flex align-items-center justify-content-center"
                            style="width:130px;height:130px;"
                        >

                            <i
                                class="bi bi-person text-secondary"
                                style="font-size:4rem;"
                            ></i>

                        </div>

                    @endif

                </div>


                {{-- Client Information --}}
                <div class="col-md-7">

                    <h3 class="mb-1">

                        {{ $testimonial->client_name }}

                    </h3>

                    @if($testimonial->designation)

                        <div class="text-muted mb-1">

                            {{ $testimonial->designation }}

                        </div>

                    @endif

                    @if($testimonial->company_name)

                        <div class="fw-semibold">

                            <i class="bi bi-building me-1"></i>

                            {{ $testimonial->company_name }}

                        </div>

                    @endif


                    {{-- Rating --}}

                    <div class="mt-3">

                        @for($i = 1; $i <= 5; $i++)

                            @if($i <= $testimonial->rating)

                                <i class="bi bi-star-fill text-warning fs-5"></i>

                            @else

                                <i class="bi bi-star text-secondary fs-5"></i>

                            @endif

                        @endfor

                        <span class="ms-2 text-muted">

                            {{ $testimonial->rating }}/5

                        </span>

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-md-3 text-md-end mt-3 mt-md-0">

                    @if($testimonial->status)

                        <span class="badge bg-success fs-6 px-3 py-2">

                            <i class="bi bi-check-circle me-1"></i>

                            Active

                        </span>

                    @else

                        <span class="badge bg-danger fs-6 px-3 py-2">

                            <i class="bi bi-x-circle me-1"></i>

                            Inactive

                        </span>

                    @endif


                    @if($testimonial->is_featured)

                        <div class="mt-2">

                            <span class="badge bg-warning text-dark px-3 py-2">

                                <i class="bi bi-star-fill me-1"></i>

                                Featured Testimonial

                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <div class="row g-4">

        {{-- =====================================================
            TESTIMONIAL CONTENT
        ====================================================== --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-quote me-2"></i>

                        Client Testimonial

                    </h6>

                </div>

                <div class="card-body">

                    <div
                        class="p-4 bg-light rounded"
                        style="font-size:1.1rem;line-height:1.8;"
                    >

                        <i class="bi bi-quote text-primary fs-3"></i>

                        <p class="mb-0 mt-2">

                            {{ $testimonial->testimonial }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            PROJECT INFORMATION
        ====================================================== --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-kanban me-2"></i>

                        Project

                    </h6>

                </div>

                <div class="card-body">

                    @if($testimonial->project)

                        <h6 class="fw-semibold">

                            {{ $testimonial->project->title }}

                        </h6>

                        @if(!empty($testimonial->project->slug))

                            <small class="text-muted">

                                /{{ $testimonial->project->slug }}

                            </small>

                        @endif

                    @else

                        <div class="text-muted text-center py-3">

                            <i class="bi bi-folder2-open fs-2 d-block mb-2"></i>

                            No project linked.

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            COMPANY LOGO
        ====================================================== --}}
        @if($testimonial->company_logo)

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">

                            <i class="bi bi-building me-2"></i>

                            Company Logo

                        </h6>

                    </div>

                    <div class="card-body text-center">

                        <img
                            src="{{ asset('storage/' . $testimonial->company_logo) }}"
                            alt="{{ $testimonial->logo_alt ?? $testimonial->company_name }}"
                            class="img-fluid border rounded p-3"
                            style="max-height:120px;"
                        >

                    </div>

                </div>

            </div>

        @endif


        {{-- =====================================================
            PUBLISHING INFORMATION
        ====================================================== --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-globe2 me-2"></i>

                        Publishing

                    </h6>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Status
                        </span>

                        @if($testimonial->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Featured
                        </span>

                        @if($testimonial->is_featured)

                            <span class="badge bg-warning text-dark">
                                Yes
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                No
                            </span>

                        @endif

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Display Order
                        </span>

                        <span class="fw-semibold">

                            {{ $testimonial->display_order }}

                        </span>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Published At
                        </span>

                        <span>

                            {{ $testimonial->published_at
                                ? $testimonial->published_at->format('d M Y, h:i A')
                                : 'Not Published'
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ADMIN INFORMATION
        ====================================================== --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white">

                    <h6 class="mb-0">

                        <i class="bi bi-person-gear me-2"></i>

                        Record Information

                    </h6>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created By
                        </small>

                        <strong>

                            {{ $testimonial->createdBy?->name ?? 'System' }}

                        </strong>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created At
                        </small>

                        <strong>

                            {{ $testimonial->created_at->format('d M Y, h:i A') }}

                        </strong>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Last Updated
                        </small>

                        <strong>

                            {{ $testimonial->updated_at->format('d M Y, h:i A') }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        DELETE
    ========================================================== --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h6 class="mb-1 text-danger">
                    Delete Testimonial
                </h6>

                <small class="text-muted">
                    This action permanently removes the testimonial
                    and its uploaded images.
                </small>

            </div>


            <form
                action="{{ route('testimonials.destroy', $testimonial) }}"
                method="POST"
                class="delete-testimonial-form"
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-outline-danger"
                >

                    <i class="bi bi-trash me-1"></i>

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

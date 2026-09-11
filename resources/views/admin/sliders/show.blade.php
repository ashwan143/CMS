@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <i class="bi bi-eye me-2"></i>
                Slider Details
            </h4>

            <p class="text-muted mb-0">
                View complete information about this slider.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('sliders.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

            <a
                href="{{ route('sliders.edit', $slider) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit Slider
            </a>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="row g-4">

        {{-- =====================================================
            LEFT COLUMN
        ====================================================== --}}
        <div class="col-lg-8">

            {{-- Desktop Image --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-image me-2"></i>
                        Desktop / Main Image
                    </h5>

                </div>

                <div class="card-body">

                    @if($slider->image)

                        <div class="text-center">

                            <img
                                src="{{ asset('storage/' . $slider->image) }}"
                                alt="{{ $slider->title }}"
                                class="img-fluid rounded border"
                                style="
                                    max-height:420px;
                                    width:100%;
                                    object-fit:cover;
                                "
                            >

                        </div>

                    @else

                        <div class="text-center py-5 text-muted">

                            <i
                                class="bi bi-image"
                                style="font-size:4rem;"
                            ></i>

                            <p class="mb-0 mt-2">
                                No desktop image available.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Mobile Image --}}
            @if($slider->mobile_image)

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            <i class="bi bi-phone me-2"></i>
                            Mobile Image
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="text-center">

                            <img
                                src="{{ asset('storage/' . $slider->mobile_image) }}"
                                alt="{{ $slider->title }}"
                                class="img-fluid rounded border"
                                style="
                                    max-height:500px;
                                    max-width:320px;
                                    object-fit:cover;
                                "
                            >

                        </div>

                    </div>

                </div>

            @endif


            {{-- Slider Content --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-card-text me-2"></i>
                        Slider Content
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <label class="text-muted small">
                            Title
                        </label>

                        <div class="fs-4 fw-semibold">
                            {{ $slider->title }}
                        </div>

                    </div>


                    <div>

                        <label class="text-muted small">
                            Subtitle / Description
                        </label>

                        @if($slider->subtitle)

                            <div class="mt-1">
                                {!! nl2br(e($slider->subtitle)) !!}
                            </div>

                        @else

                            <span class="text-muted">
                                No subtitle provided.
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- CTA --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-box-arrow-up-right me-2"></i>
                        Call To Action
                    </h5>

                </div>

                <div class="card-body">

                    @if($slider->button_text)

                        <div class="row g-3">

                            <div class="col-md-4">

                                <label class="text-muted small">
                                    Button Text
                                </label>

                                <div class="fw-semibold">
                                    {{ $slider->button_text }}
                                </div>

                            </div>

                            <div class="col-md-5">

                                <label class="text-muted small">
                                    Button URL
                                </label>

                                <div>
                                    {{ $slider->button_url ?: '—' }}
                                </div>

                            </div>

                            <div class="col-md-3">

                                <label class="text-muted small">
                                    Target
                                </label>

                                <div>

                                    @if($slider->button_target === '_blank')

                                        <span class="badge bg-info text-dark">
                                            New Tab
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Same Tab
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @else

                        <span class="text-muted">
                            No call-to-action button configured.
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT COLUMN
        ====================================================== --}}
        <div class="col-lg-4">

            {{-- Status --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-activity me-2"></i>
                        Status
                    </h5>

                </div>

                <div class="card-body">

                    @if($slider->status)

                        <span class="badge bg-success fs-6">
                            Active
                        </span>

                    @else

                        <span class="badge bg-danger fs-6">
                            Inactive
                        </span>

                    @endif

                </div>

            </div>


            {{-- Display Settings --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-sliders me-2"></i>
                        Display Settings
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="text-muted small">
                            Display Order
                        </label>

                        <div>

                            <span class="badge bg-dark">
                                {{ $slider->display_order }}
                            </span>

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="text-muted small">
                            Alignment
                        </label>

                        <div>

                            <span class="badge bg-light text-dark border">

                                {{ ucfirst($slider->alignment) }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Schedule --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-calendar-event me-2"></i>
                        Schedule
                    </h5>

                </div>

                <div class="card-body">

                    @if($slider->start_date || $slider->end_date)

                        @php

                            $now = now();

                            $isScheduled =
                                $slider->start_date &&
                                $now->lt($slider->start_date);

                            $isExpired =
                                $slider->end_date &&
                                $now->gt($slider->end_date);

                        @endphp


                        <div class="mb-3">

                            @if($isScheduled)

                                <span class="badge bg-warning text-dark">
                                    Scheduled
                                </span>

                            @elseif($isExpired)

                                <span class="badge bg-secondary">
                                    Expired
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Running
                                </span>

                            @endif

                        </div>


                        @if($slider->start_date)

                            <div class="mb-3">

                                <label class="text-muted small">
                                    Start Date
                                </label>

                                <div>
                                    {{ $slider->start_date->format('d M Y, h:i A') }}
                                </div>

                            </div>

                        @endif


                        @if($slider->end_date)

                            <div>

                                <label class="text-muted small">
                                    End Date
                                </label>

                                <div>
                                    {{ $slider->end_date->format('d M Y, h:i A') }}
                                </div>

                            </div>

                        @endif

                    @else

                        <span class="text-muted">
                            No schedule configured.
                        </span>

                    @endif

                </div>

            </div>


            {{-- Audit Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Audit Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="text-muted small">
                            Created By
                        </label>

                        <div>

                            {{ $slider->createdBy->name ?? 'System' }}

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="text-muted small">
                            Created At
                        </label>

                        <div>

                            {{ $slider->created_at
                                ? $slider->created_at->format('d M Y, h:i A')
                                : '—'
                            }}

                        </div>

                    </div>


                    <div>

                        <label class="text-muted small">
                            Last Updated
                        </label>

                        <div>

                            {{ $slider->updated_at
                                ? $slider->updated_at->format('d M Y, h:i A')
                                : '—'
                            }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

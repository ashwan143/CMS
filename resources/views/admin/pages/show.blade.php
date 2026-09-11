
@extends('admin.layouts.app')

@section('title', 'View Page')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                View Page
            </h2>

            <p class="text-muted mb-0">
                View page details and content.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('pages.edit', $page) }}"
               class="btn btn-primary">

                <i class="bi bi-pencil me-1"></i>
                Edit

            </a>

            <a href="{{ route('pages.index') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Back

            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- Main Content --}}
        <div class="col-lg-8">

            {{-- Page Information --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">

                        <i class="bi bi-file-earmark-text me-2"></i>
                        Page Information

                    </h5>

                </div>

                <div class="card-body">

                    {{-- Title --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            PAGE TITLE
                        </label>

                        <h3 class="mb-0">
                            {{ $page->title }}
                        </h3>

                    </div>


                    {{-- Slug --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            URL SLUG
                        </label>

                        <div>

                            <code>
                                /{{ $page->slug }}
                            </code>

                        </div>

                    </div>


                    {{-- Short Description --}}
                    @if($page->short_description)

                        <div class="mb-4">

                            <label class="text-muted small">
                                SHORT DESCRIPTION
                            </label>

                            <p class="mb-0">
                                {{ $page->short_description }}
                            </p>

                        </div>

                    @endif


                    {{-- Content --}}
                    <div>

                        <label class="text-muted small mb-2 d-block">
                            PAGE CONTENT
                        </label>

                        <div class="border rounded p-4 bg-light">

                            {!! $page->content !!}

                        </div>

                    </div>

                </div>

            </div>


            {{-- Featured Image --}}
            @if($page->featured_image)

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">

                            <i class="bi bi-image me-2"></i>
                            Featured Image

                        </h5>

                    </div>

                    <div class="card-body text-center">

                        <img src="{{ asset('storage/' . $page->featured_image) }}"
                             alt="{{ $page->title }}"
                             class="img-fluid rounded"
                             style="max-height: 450px;">

                    </div>

                </div>

            @endif

        </div>


        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Page Status --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">

                        <i class="bi bi-gear me-2"></i>
                        Page Settings

                    </h5>

                </div>

                <div class="card-body">

                    {{-- Status --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Status
                        </span>

                        @if($page->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </div>


                    {{-- Template --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Template
                        </span>

                        <span class="fw-semibold">

                            {{ ucwords(str_replace('-', ' ', $page->template)) }}

                        </span>

                    </div>


                    {{-- Display Order --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Display Order
                        </span>

                        <span class="fw-semibold">
                            {{ $page->display_order }}
                        </span>

                    </div>


                    {{-- Created By --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Created By
                        </span>

                        <span class="fw-semibold">

                            {{ $page->createdBy?->name ?? 'System' }}

                        </span>

                    </div>


                    {{-- Created At --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted">
                            Created
                        </span>

                        <span>

                            {{ $page->created_at?->format('d M Y, h:i A') }}

                        </span>

                    </div>


                    {{-- Updated At --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Last Updated
                        </span>

                        <span>

                            {{ $page->updated_at?->format('d M Y, h:i A') }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- Frontend URL --}}
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">

                        <i class="bi bi-globe me-2"></i>
                        Frontend

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted small">
                        Page URL
                    </p>

                    <div class="input-group">

                        <input type="text"
                               class="form-control"
                               value="{{ url($page->slug) }}"
                               readonly>

                        <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="copyPageUrl()">

                            <i class="bi bi-copy"></i>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

function copyPageUrl() {

    const input = document.querySelector(
        'input[readonly]'
    );

    navigator.clipboard.writeText(input.value);

    const button = event.currentTarget;

    const original = button.innerHTML;

    button.innerHTML =
        '<i class="bi bi-check-lg"></i>';

    setTimeout(function () {

        button.innerHTML = original;

    }, 1500);

}

</script>

@endsection


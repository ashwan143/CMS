@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-images me-2"></i>
                Sliders
            </h4>

            <p class="text-muted mb-0">
                Manage website banners and hero sections.
            </p>
        </div>

        <div class="mt-3 mt-md-0">

            <a
                href="{{ route('sliders.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Add Slider
            </a>

        </div>

    </div>


    {{-- =========================================================
        SEARCH & FILTER
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('sliders.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-6">

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
                                placeholder="Search slider title or subtitle..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-lg-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="1"
                                @selected(request('status') === '1')
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                @selected(request('status') === '0')
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-lg-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-search me-1"></i>
                                Filter
                            </button>

                            <a
                                href="{{ route('sliders.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                <i class="bi bi-arrow-counterclockwise me-1"></i>
                                Reset
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        SLIDER TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    <i class="bi bi-collection me-2"></i>
                    Slider List
                </h5>

                <span class="badge bg-secondary">

                    {{ $sliders->total() }}

                    {{ Str::plural('Slider', $sliders->total()) }}

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($sliders->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th width="70">
                                    #
                                </th>

                                <th width="130">
                                    Image
                                </th>

                                <th>
                                    Slider
                                </th>

                                <th>
                                    CTA
                                </th>

                                <th>
                                    Schedule
                                </th>

                                <th width="100">
                                    Order
                                </th>

                                <th width="100">
                                    Status
                                </th>

                                <th width="160" class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($sliders as $slider)

                                <tr>

                                    {{-- =====================================
                                        Number
                                    ====================================== --}}
                                    <td>

                                        {{ $sliders->firstItem() + $loop->index }}

                                    </td>


                                    {{-- =====================================
                                        Image
                                    ====================================== --}}
                                    <td>

                                        @if($slider->image)

                                            <img
                                                src="{{ asset('storage/' . $slider->image) }}"
                                                alt="{{ $slider->title }}"
                                                class="rounded border"
                                                style="
                                                    width:110px;
                                                    height:65px;
                                                    object-fit:cover;
                                                "
                                            >

                                        @else

                                            <div
                                                class="bg-light border rounded d-flex align-items-center justify-content-center"
                                                style="
                                                    width:110px;
                                                    height:65px;
                                                "
                                            >
                                                <i class="bi bi-image text-muted fs-4"></i>
                                            </div>

                                        @endif

                                    </td>


                                    {{-- =====================================
                                        Slider Information
                                    ====================================== --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $slider->title }}
                                        </div>

                                        @if($slider->subtitle)

                                            <div
                                                class="text-muted small mt-1"
                                                style="max-width:350px;"
                                            >
                                                {{ Str::limit($slider->subtitle, 90) }}
                                            </div>

                                        @endif

                                        <div class="mt-2">

                                            @if($slider->alignment === 'left')

                                                <span class="badge bg-light text-dark border">
                                                    Left
                                                </span>

                                            @elseif($slider->alignment === 'center')

                                                <span class="badge bg-light text-dark border">
                                                    Center
                                                </span>

                                            @else

                                                <span class="badge bg-light text-dark border">
                                                    Right
                                                </span>

                                            @endif

                                            @if($slider->mobile_image)

                                                <span class="badge bg-info text-dark">
                                                    <i class="bi bi-phone me-1"></i>
                                                    Mobile
                                                </span>

                                            @endif

                                        </div>

                                    </td>


                                    {{-- =====================================
                                        CTA
                                    ====================================== --}}
                                    <td>

                                        @if($slider->button_text)

                                            <div class="fw-semibold">
                                                {{ $slider->button_text }}
                                            </div>

                                            @if($slider->button_url)

                                                <div class="small text-muted">

                                                    {{ Str::limit(
                                                        $slider->button_url,
                                                        35
                                                    ) }}

                                                </div>

                                            @endif

                                        @else

                                            <span class="text-muted">
                                                No CTA
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================
                                        Schedule
                                    ====================================== --}}
                                    <td>

                                        @if($slider->start_date || $slider->end_date)

                                            @php

                                                $now = now();

                                                $isScheduled = (
                                                    $slider->start_date &&
                                                    $now->lt($slider->start_date)
                                                );

                                                $isExpired = (
                                                    $slider->end_date &&
                                                    $now->gt($slider->end_date)
                                                );

                                            @endphp


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


                                            <div class="small text-muted mt-1">

                                                @if($slider->start_date)

                                                    From:
                                                    {{ $slider->start_date->format('d M Y') }}

                                                @endif

                                                @if($slider->end_date)

                                                    <br>

                                                    Until:
                                                    {{ $slider->end_date->format('d M Y') }}

                                                @endif

                                            </div>

                                        @else

                                            <span class="text-muted small">
                                                Always active
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================
                                        Order
                                    ====================================== --}}
                                    <td>

                                        <span class="badge bg-dark">

                                            {{ $slider->display_order }}

                                        </span>

                                    </td>


                                    {{-- =====================================
                                        Status
                                    ====================================== --}}
                                    <td>

                                        @if($slider->status)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =====================================
                                        Actions
                                    ====================================== --}}
                                    <td class="text-end">

                                        <div class="btn-group">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('sliders.show', $slider) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('sliders.edit', $slider) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('sliders.destroy', $slider) }}"
                                                method="POST"
                                                class="d-inline delete-slider-form"
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

                {{-- =============================================
                    EMPTY STATE
                ============================================== --}}
                <div class="text-center py-5">

                    <div class="mb-3">

                        <i
                            class="bi bi-images text-muted"
                            style="font-size:3rem;"
                        ></i>

                    </div>

                    <h5>
                        No sliders found
                    </h5>

                    <p class="text-muted mb-3">

                        @if(request()->filled('search') ||
                            request()->filled('status'))

                            No sliders match your current filters.

                        @else

                            You haven't created any sliders yet.

                        @endif

                    </p>

                    <a
                        href="{{ route('sliders.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Create First Slider
                    </a>

                </div>

            @endif

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($sliders->hasPages())

            <div class="card-footer bg-white">

                {{ $sliders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

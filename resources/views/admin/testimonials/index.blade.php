@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">

                <i class="bi bi-chat-quote me-2"></i>

                Testimonials

            </h4>

            <p class="text-muted mb-0">

                Manage client reviews and testimonials.

            </p>

        </div>


        <a
            href="{{ route('testimonials.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-lg me-1"></i>

            Add Testimonial

        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('testimonials.index') }}"
            >

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-4">

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
                                placeholder="Client, company or testimonial..."
                            >

                        </div>

                    </div>


                    {{-- Project --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Project
                        </label>

                        <select
                            name="project_id"
                            class="form-select"
                        >

                            <option value="">
                                All Projects
                            </option>

                            @foreach($projects as $project)

                                <option
                                    value="{{ $project->id }}"
                                    {{ request('project_id') == $project->id ? 'selected' : '' }}
                                >
                                    {{ $project->title }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Rating --}}
                    <div class="col-lg-2">

                        <label class="form-label">
                            Rating
                        </label>

                        <select
                            name="rating"
                            class="form-select"
                        >

                            <option value="">
                                All Ratings
                            </option>

                            @for($rating = 5; $rating >= 1; $rating--)

                                <option
                                    value="{{ $rating }}"
                                    {{ request('rating') == $rating ? 'selected' : '' }}
                                >
                                    {{ $rating }} Stars
                                </option>

                            @endfor

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
                                All Status
                            </option>

                            <option
                                value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-lg-2 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-funnel me-1"></i>

                            Filter

                        </button>


                        <a
                            href="{{ route('testimonials.index') }}"
                            class="btn btn-outline-secondary"
                            title="Reset"
                        >

                            <i class="bi bi-arrow-counterclockwise"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        TESTIMONIAL TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h6 class="mb-0">

                <i class="bi bi-list-ul me-2"></i>

                All Testimonials

            </h6>


            <span class="badge bg-secondary">

                {{ $testimonials->total() }} Total

            </span>

        </div>


        <div class="card-body p-0">

            @if($testimonials->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-3">
                                    Client
                                </th>

                                <th>
                                    Company
                                </th>

                                <th>
                                    Testimonial
                                </th>

                                <th>
                                    Rating
                                </th>

                                <th>
                                    Project
                                </th>

                                <th>
                                    Featured
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Order
                                </th>

                                <th class="text-end px-3">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($testimonials as $testimonial)

                                <tr>

                                    {{-- Client --}}
                                    <td class="px-3">

                                        <div class="d-flex align-items-center">

                                            @if($testimonial->client_photo)

                                                <img
                                                    src="{{ asset('storage/' . $testimonial->client_photo) }}"
                                                    alt="{{ $testimonial->photo_alt ?? $testimonial->client_name }}"
                                                    class="rounded-circle me-2"
                                                    width="45"
                                                    height="45"
                                                    style="object-fit:cover;"
                                                >

                                            @else

                                                <div
                                                    class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                                    style="
                                                        width:45px;
                                                        height:45px;
                                                    "
                                                >

                                                    <i class="bi bi-person text-muted"></i>

                                                </div>

                                            @endif


                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $testimonial->client_name }}

                                                </div>

                                                @if($testimonial->designation)

                                                    <small class="text-muted">

                                                        {{ $testimonial->designation }}

                                                    </small>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Company --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            @if($testimonial->company_logo)

                                                <img
                                                    src="{{ asset('storage/' . $testimonial->company_logo) }}"
                                                    alt="{{ $testimonial->logo_alt ?? $testimonial->company_name }}"
                                                    width="35"
                                                    height="35"
                                                    class="me-2"
                                                    style="object-fit:contain;"
                                                >

                                            @endif

                                            <span>

                                                {{ $testimonial->company_name ?? '—' }}

                                            </span>

                                        </div>

                                    </td>


                                    {{-- Testimonial --}}
                                    <td style="min-width:260px;">

                                        <div
                                            class="text-muted"
                                            style="
                                                display:-webkit-box;
                                                -webkit-line-clamp:2;
                                                -webkit-box-orient:vertical;
                                                overflow:hidden;
                                            "
                                        >

                                            {{ $testimonial->testimonial }}

                                        </div>

                                    </td>


                                    {{-- Rating --}}
                                    <td>

                                        <div class="text-warning">

                                            @for($i = 1; $i <= 5; $i++)

                                                @if($i <= $testimonial->rating)

                                                    <i class="bi bi-star-fill"></i>

                                                @else

                                                    <i class="bi bi-star"></i>

                                                @endif

                                            @endfor

                                        </div>

                                    </td>


                                    {{-- Project --}}
                                    <td>

                                        @if($testimonial->project)

                                            <span class="badge bg-light text-dark">

                                                {{ $testimonial->project->title }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Featured --}}
                                    <td>

                                        @if($testimonial->is_featured)

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-star-fill me-1"></i>

                                                Featured

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                No
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($testimonial->status)

                                            <span class="badge bg-success">

                                                Active

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Order --}}
                                    <td>

                                        <span class="badge bg-secondary">

                                            {{ $testimonial->display_order }}

                                        </span>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="text-end px-3">

                                        <div class="dropdown">

                                            <button
                                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                            >

                                                Actions

                                            </button>


                                            <ul class="dropdown-menu dropdown-menu-end">

                                                <li>

                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('testimonials.show', $testimonial) }}"
                                                    >

                                                        <i class="bi bi-eye me-2"></i>

                                                        View

                                                    </a>

                                                </li>


                                                <li>

                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('testimonials.edit', $testimonial) }}"
                                                    >

                                                        <i class="bi bi-pencil me-2"></i>

                                                        Edit

                                                    </a>

                                                </li>


                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>


                                                <li>

                                                    <form
                                                        action="{{ route('testimonials.destroy', $testimonial) }}"
                                                        method="POST"
                                                        class="delete-testimonial-form"
                                                    >

                                                        @csrf

                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="dropdown-item text-danger"
                                                        >

                                                            <i class="bi bi-trash me-2"></i>

                                                            Delete

                                                        </button>

                                                    </form>

                                                </li>

                                            </ul>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($testimonials->hasPages())

                    <div class="p-3 border-top">

                        {{ $testimonials->links() }}

                    </div>

                @endif

            @else

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}
                <div class="text-center py-5">

                    <div
                        class="mb-3 text-muted"
                        style="font-size:4rem;"
                    >

                        <i class="bi bi-chat-square-quote"></i>

                    </div>

                    <h5>
                        No Testimonials Found
                    </h5>

                    <p class="text-muted mb-4">

                        Start building your client reviews by adding
                        your first testimonial.

                    </p>

                    <a
                        href="{{ route('testimonials.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Add First Testimonial

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

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
                Albums
            </h4>

            <p class="text-muted mb-0">
                Manage your company gallery albums.
            </p>
        </div>

        <div>

            <a href="{{ route('albums.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>

                Create Album

            </a>

        </div>

    </div>


    {{-- =========================================================
        SEARCH / FILTER
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('albums.index') }}"
                method="GET"
            >

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

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Search album title or slug..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3">

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
                    <div class="col-md-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a
                                href="{{ route('albums.index') }}"
                                class="btn btn-outline-secondary"
                            >

                                <i class="bi bi-arrow-clockwise"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        ALBUM TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                #
                            </th>

                            <th width="100">
                                Cover
                            </th>

                            <th>
                                Album
                            </th>

                            <th>
                                Images
                            </th>

                            <th>
                                Order
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Created By
                            </th>

                            <th>
                                Created
                            </th>

                            <th
                                width="150"
                                class="text-end"
                            >
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($albums as $album)

                            <tr>

                                {{-- ID --}}
                                <td>

                                    <span class="text-muted">
                                        #{{ $album->id }}
                                    </span>

                                </td>


                                {{-- Cover --}}
                                <td>

                                    @if($album->cover_image)

                                        <img
                                            src="{{ asset('storage/' . $album->cover_image) }}"
                                            alt="{{ $album->title }}"
                                            class="rounded border"
                                            width="70"
                                            height="50"
                                            style="object-fit: cover;"
                                        >

                                    @else

                                        <div
                                            class="bg-light border rounded d-flex align-items-center justify-content-center"
                                            style="
                                                width:70px;
                                                height:50px;
                                            "
                                        >

                                            <i class="bi bi-image text-muted fs-5"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- Album --}}
                                <td>

                                    <div class="fw-semibold">

                                        {{ $album->title }}

                                    </div>

                                    <small class="text-muted">

                                        /{{ $album->slug }}

                                    </small>

                                    @if($album->description)

                                        <div class="text-muted small mt-1">

                                            {{ Str::limit($album->description, 80) }}

                                        </div>

                                    @endif

                                </td>


                                {{-- Image Count --}}
                                <td>

                                    <span class="badge bg-info text-dark">

                                        <i class="bi bi-images me-1"></i>

                                        {{ $album->gallery_images_count }}

                                    </span>

                                </td>


                                {{-- Order --}}
                                <td>

                                    <span class="badge bg-secondary">

                                        {{ $album->order }}

                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

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

                                </td>


                                {{-- Created By --}}
                                <td>

                                    @if($album->createdBy)

                                        <span>

                                            <i class="bi bi-person me-1"></i>

                                            {{ $album->createdBy->name }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            System
                                        </span>

                                    @endif

                                </td>


                                {{-- Created --}}
                                <td>

                                    <span
                                        title="{{ $album->created_at?->format('d M Y, h:i A') }}"
                                    >

                                        {{ $album->created_at?->format('d M Y') }}

                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('albums.show', $album) }}"
                                            class="btn btn-sm btn-outline-info"
                                            title="View"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('albums.edit', $album) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('albums.destroy', $album) }}"
                                            method="POST"
                                            class="delete-album-form d-inline"
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

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center py-5"
                                >

                                    <div class="mb-3">

                                        <i
                                            class="bi bi-images text-muted"
                                            style="font-size: 3rem;"
                                        ></i>

                                    </div>

                                    <h6 class="mb-1">
                                        No albums found
                                    </h6>

                                    <p class="text-muted mb-3">

                                        Create your first gallery album.

                                    </p>

                                    <a
                                        href="{{ route('albums.create') }}"
                                        class="btn btn-primary btn-sm"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Create Album

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($albums->hasPages())

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="text-muted small">

                        Showing
                        <strong>
                            {{ $albums->firstItem() }}
                        </strong>

                        to

                        <strong>
                            {{ $albums->lastItem() }}
                        </strong>

                        of

                        <strong>
                            {{ $albums->total() }}
                        </strong>

                        albums

                    </div>


                    <div>

                        {{ $albums->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection

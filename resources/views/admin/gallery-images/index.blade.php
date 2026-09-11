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

                Gallery Images

            </h4>

            <p class="text-muted mb-0">

                Manage images across your website albums.

            </p>

        </div>


        <div>

            <a
                href="{{ route('gallery-images.create') }}"
                class="btn btn-primary"
            >

                <i class="bi bi-plus-lg me-1"></i>

                Add Gallery Image

            </a>

        </div>

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
        SEARCH & FILTERS
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('gallery-images.index') }}"
                method="GET"
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
                                placeholder="Search image title or ALT text..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    {{-- Album --}}
                    <div class="col-lg-3">

                        <label class="form-label">
                            Album
                        </label>

                        <select
                            name="album_id"
                            class="form-select"
                        >

                            <option value="">
                                All Albums
                            </option>

                            @foreach($albums as $album)

                                <option
                                    value="{{ $album->id }}"
                                    {{ request('album_id') == $album->id ? 'selected' : '' }}
                                >

                                    {{ $album->title }}

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
                    <div class="col-lg-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a
                                href="{{ route('gallery-images.index') }}"
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
        GALLERY GRID
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>

                <h6 class="mb-1">

                    <i class="bi bi-grid-3x3-gap me-2"></i>

                    Gallery Images

                </h6>

                <small class="text-muted">

                    {{ $galleryImages->total() }}
                    {{ Str::plural('image', $galleryImages->total()) }}

                </small>

            </div>

        </div>


        <div class="card-body">

            @if($galleryImages->count())

                <div class="row g-4">

                    @foreach($galleryImages as $galleryImage)

                        <div class="col-sm-6 col-md-4 col-lg-3">

                            <div class="card border h-100 shadow-sm">

                                {{-- Image --}}
                                <div class="position-relative">

                                    <img
                                        src="{{ asset('storage/' . $galleryImage->image) }}"
                                        alt="{{ $galleryImage->alt_text ?? $galleryImage->title ?? 'Gallery Image' }}"
                                        class="card-img-top"
                                        style="
                                            height:200px;
                                            object-fit:cover;
                                        "
                                    >


                                    {{-- Status --}}
                                    <div
                                        class="position-absolute top-0 end-0 m-2"
                                    >

                                        @if($galleryImage->status)

                                            <span class="badge bg-success">

                                                Active

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- Content --}}
                                <div class="card-body">

                                    <h6 class="card-title mb-2">

                                        {{ $galleryImage->title ?? 'Untitled Image' }}

                                    </h6>


                                    <div class="small text-muted mb-2">

                                        <i class="bi bi-folder me-1"></i>

                                        {{ $galleryImage->album?->title ?? 'No Album' }}

                                    </div>


                                    <div class="small text-muted">

                                        <i class="bi bi-sort-numeric-down me-1"></i>

                                        Order:
                                        {{ $galleryImage->order }}

                                    </div>

                                </div>


                                {{-- Actions --}}
                                <div class="card-footer bg-white border-top">

                                    <div class="d-flex justify-content-between">

                                        <a
                                            href="{{ route('gallery-images.show', $galleryImage) }}"
                                            class="btn btn-sm btn-outline-info"
                                            title="View"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a
                                            href="{{ route('gallery-images.edit', $galleryImage) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route('gallery-images.destroy', $galleryImage) }}"
                                            method="POST"
                                            class="delete-gallery-image-form"
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

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}
                <div class="mt-4">

                    {{ $galleryImages->links() }}

                </div>

            @else

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}
                <div class="text-center py-5">

                    <i
                        class="bi bi-images text-muted"
                        style="font-size:4rem;"
                    ></i>

                    <h5 class="mt-3">

                        No Gallery Images Found

                    </h5>

                    <p class="text-muted">

                        Start building your gallery by adding an image.

                    </p>


                    <a
                        href="{{ route('gallery-images.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Add Gallery Image

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

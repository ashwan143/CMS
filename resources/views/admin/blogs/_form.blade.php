{{-- =========================================================
    BLOG BASIC INFORMATION
========================================================= --}}

<div class="row g-4">

    {{-- =====================================================
        LEFT COLUMN
    ====================================================== --}}
    <div class="col-lg-8">

        {{-- Blog Title --}}
        <div class="mb-3">

            <label for="title" class="form-label">
                Blog Title
                <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="title"
                id="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $blog->title ?? '') }}"
                placeholder="Enter blog title"
                required
            >

            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Short Description --}}
        <div class="mb-3">

            <label for="short_description" class="form-label">
                Short Description
            </label>

            <textarea
                name="short_description"
                id="short_description"
                rows="4"
                class="form-control @error('short_description') is-invalid @enderror"
                placeholder="Write a short summary of the blog..."
            >{{ old('short_description', $blog->short_description ?? '') }}</textarea>

            @error('short_description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Content --}}
        <div class="mb-3">

            <label for="content" class="form-label">
                Blog Content
                <span class="text-danger">*</span>
            </label>

            <textarea
                name="content"
                id="content"
                rows="15"
                class="form-control @error('content') is-invalid @enderror"
                placeholder="Write your blog content here..."
                required
            >{{ old('content', $blog->content ?? '') }}</textarea>

            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <small class="text-muted">
                Use proper headings, paragraphs, lists and links for readable content.
            </small>

        </div>

    </div>


    {{-- =====================================================
        RIGHT COLUMN
    ====================================================== --}}
    <div class="col-lg-4">

        {{-- Category --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-folder me-2"></i>
                    Category
                </h6>

            </div>

            <div class="card-body">

                <label
                    for="category_id"
                    class="form-label"
                >
                    Blog Category
                </label>

                <select
                    name="category_id"
                    id="category_id"
                    class="form-select @error('category_id') is-invalid @enderror"
                >

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(
                                old(
                                    'category_id',
                                    $blog->category_id ?? ''
                                ) == $category->id
                            )
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        {{-- Tags --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-tags me-2"></i>
                    Tags
                </h6>

            </div>

            <div class="card-body">

                @php

                    $selectedTags = old(
                        'tags',
                        isset($blog)
                            ? $blog->tags->pluck('id')->toArray()
                            : []
                    );

                @endphp

                @if($tags->count())

                    <div class="row g-2">

                        @foreach($tags as $tag)

                            <div class="col-12">

                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        name="tags[]"
                                        value="{{ $tag->id }}"
                                        id="tag_{{ $tag->id }}"
                                        class="form-check-input"
                                        @checked(
                                            in_array(
                                                $tag->id,
                                                $selectedTags
                                            )
                                        )
                                    >

                                    <label
                                        for="tag_{{ $tag->id }}"
                                        class="form-check-label"
                                    >
                                        {{ $tag->name }}
                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="text-muted small mb-0">
                        No active tags available.
                    </p>

                @endif

                @error('tags')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror

                @error('tags.*')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        {{-- Featured Image --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-image me-2"></i>
                    Featured Image
                </h6>

            </div>

            <div class="card-body">

                <input
                    type="file"
                    name="featured_image"
                    id="featured_image"
                    class="form-control @error('featured_image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/webp"
                >

                @error('featured_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                {{-- New Image Preview --}}
                <div
                    id="imagePreviewContainer"
                    class="mt-3 d-none"
                >

                    <img
                        id="imagePreview"
                        src=""
                        alt="Image Preview"
                        class="img-fluid rounded border"
                        style="max-height:200px; object-fit:cover;"
                    >

                </div>


                {{-- Existing Image --}}
                @if(isset($blog) && $blog->featured_image)

                    <div class="mt-3">

                        <small class="text-muted d-block mb-2">
                            Current Image
                        </small>

                        <img
                            src="{{ asset('storage/' . $blog->featured_image) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid rounded border"
                            style="max-height:200px; object-fit:cover;"
                        >

                    </div>

                @endif

                <small class="text-muted d-block mt-2">
                    JPG, JPEG, PNG or WEBP. Maximum size: 5MB.
                </small>

            </div>

        </div>


        {{-- Publishing --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-calendar-check me-2"></i>
                    Publishing
                </h6>

            </div>

            <div class="card-body">

                {{-- Status --}}
                <div class="mb-3">

                    <label
                        for="status"
                        class="form-label"
                    >
                        Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                    >

                        <option
                            value="0"
                            @selected(
                                old(
                                    'status',
                                    isset($blog)
                                        ? (int) $blog->status
                                        : 0
                                ) == 0
                            )
                        >
                            Draft
                        </option>

                        <option
                            value="1"
                            @selected(
                                old(
                                    'status',
                                    isset($blog)
                                        ? (int) $blog->status
                                        : 0
                                ) == 1
                            )
                        >
                            Published
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Published At --}}
                <div class="mb-3">

                    <label
                        for="published_at"
                        class="form-label"
                    >
                        Published Date
                    </label>

                    <input
                        type="datetime-local"
                        name="published_at"
                        id="published_at"
                        class="form-control @error('published_at') is-invalid @enderror"
                        value="{{
                            old(
                                'published_at',
                                isset($blog) && $blog->published_at
                                    ? $blog->published_at->format('Y-m-d\TH:i')
                                    : ''
                            )
                        }}"
                    >

                    @error('published_at')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Display Order --}}
                <div>

                    <label
                        for="order"
                        class="form-label"
                    >
                        Display Order
                    </label>

                    <input
                        type="number"
                        name="order"
                        id="order"
                        min="0"
                        class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', $blog->order ?? 0) }}"
                    >

                    @error('order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    SEO SECTION
========================================================= --}}

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h6 class="mb-0">

            <i class="bi bi-search me-2"></i>

            Search Engine Optimization

        </h6>

    </div>


    <div class="card-body">

        <div class="row g-3">

            {{-- SEO Title --}}
            <div class="col-lg-6">

                <label
                    for="seo_title"
                    class="form-label"
                >
                    SEO Title
                </label>

                <input
                    type="text"
                    name="seo_title"
                    id="seo_title"
                    maxlength="255"
                    class="form-control @error('seo_title') is-invalid @enderror"
                    value="{{ old('seo_title', $blog->seo_title ?? '') }}"
                    placeholder="SEO optimized title"
                >

                @error('seo_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- SEO Description --}}
            <div class="col-lg-6">

                <label
                    for="seo_description"
                    class="form-label"
                >
                    SEO Description
                </label>

                <textarea
                    name="seo_description"
                    id="seo_description"
                    rows="3"
                    maxlength="500"
                    class="form-control @error('seo_description') is-invalid @enderror"
                    placeholder="SEO meta description"
                >{{ old('seo_description', $blog->seo_description ?? '') }}</textarea>

                @error('seo_description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    IMAGE PREVIEW SCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const imageInput =
        document.getElementById('featured_image');

    const previewContainer =
        document.getElementById('imagePreviewContainer');

    const preview =
        document.getElementById('imagePreview');


    if (imageInput) {

        imageInput.addEventListener('change', function (event) {

            const file =
                event.target.files[0];


            if (!file) {

                previewContainer.classList.add('d-none');

                preview.src = '';

                return;
            }


            if (!file.type.startsWith('image/')) {

                previewContainer.classList.add('d-none');

                preview.src = '';

                return;
            }


            const reader =
                new FileReader();


            reader.onload = function (e) {

                preview.src =
                    e.target.result;

                previewContainer.classList.remove('d-none');
            };


            reader.readAsDataURL(file);

        });

    }

});

</script>

@endpush

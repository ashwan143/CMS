{{-- =========================================================
    ALBUM BASIC INFORMATION
========================================================= --}}

<div class="row g-4">

    {{-- =====================================================
        LEFT COLUMN
    ====================================================== --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h6 class="mb-0">

                    <i class="bi bi-images me-2"></i>

                    Album Information

                </h6>

            </div>


            <div class="card-body">

                {{-- Album Title --}}
                <div class="mb-3">

                    <label
                        for="title"
                        class="form-label"
                    >
                        Album Title
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $album->title ?? '') }}"
                        placeholder="Example: Company Events"
                        required
                    >

                    @error('title')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label
                        for="description"
                        class="form-label"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Describe this album..."
                    >{{ old('description', $album->description ?? '') }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Cover Image --}}
                <div class="mb-3">

                    <label
                        for="cover_image"
                        class="form-label"
                    >
                        Cover Image
                    </label>

                    <input
                        type="file"
                        id="cover_image"
                        name="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <div class="form-text">

                        JPG, JPEG, PNG or WEBP.
                        Maximum size: 5 MB.

                    </div>

                    @error('cover_image')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Current Cover --}}
                @if(!empty($album?->cover_image))

                    <div class="mb-3">

                        <label class="form-label">
                            Current Cover
                        </label>

                        <div>

                            <img
                                src="{{ asset('storage/' . $album->cover_image) }}"
                                alt="{{ $album->title }}"
                                class="img-thumbnail"
                                style="
                                    width:220px;
                                    height:130px;
                                    object-fit:cover;
                                "
                            >

                        </div>

                    </div>

                @endif


                {{-- New Image Preview --}}
                <div
                    id="coverPreviewWrapper"
                    class="mb-3 d-none"
                >

                    <label class="form-label">
                        New Cover Preview
                    </label>

                    <div>

                        <img
                            id="coverPreview"
                            src="#"
                            alt="Cover Preview"
                            class="img-thumbnail"
                            style="
                                width:220px;
                                height:130px;
                                object-fit:cover;
                            "
                        >

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        RIGHT COLUMN
    ====================================================== --}}
    <div class="col-lg-4">

        {{-- Publishing Settings --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h6 class="mb-0">

                    <i class="bi bi-sliders me-2"></i>

                    Album Settings

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
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >

                        <option
                            value="1"
                            {{ old('status', $album->status ?? 1) == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('status', $album->status ?? 1) == 0 ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Display Order --}}
                <div class="mb-3">

                    <label
                        for="order"
                        class="form-label"
                    >
                        Display Order
                    </label>

                    <input
                        type="number"
                        id="order"
                        name="order"
                        class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', $album->order ?? 0) }}"
                        min="0"
                    >

                    <div class="form-text">

                        Lower numbers appear first.

                    </div>

                    @error('order')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- Information --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex align-items-start gap-3">

                    <i class="bi bi-info-circle text-primary fs-4"></i>

                    <div>

                        <h6 class="mb-1">
                            Album
                        </h6>

                        <p class="text-muted small mb-0">

                            After creating the album, you can
                            add and manage gallery images inside it.

                        </p>

                    </div>

                </div>

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

    const input = document.getElementById('cover_image');

    const previewWrapper =
        document.getElementById('coverPreviewWrapper');

    const preview =
        document.getElementById('coverPreview');


    if (!input) {
        return;
    }


    input.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {

            previewWrapper.classList.add('d-none');

            preview.removeAttribute('src');

            return;
        }


        if (!file.type.startsWith('image/')) {

            previewWrapper.classList.add('d-none');

            preview.removeAttribute('src');

            return;
        }


        const reader = new FileReader();


        reader.onload = function (e) {

            preview.src = e.target.result;

            previewWrapper.classList.remove('d-none');

        };


        reader.readAsDataURL(file);

    });

});

</script>

@endpush

<div class="row g-4">

    {{-- =========================================================
        LEFT COLUMN
    ========================================================== --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-image me-2"></i>
                    Image Information
                </h6>

            </div>

            <div class="card-body">

                {{-- Album --}}
                <div class="mb-3">

                    <label for="album_id" class="form-label">
                        Album <span class="text-danger">*</span>
                    </label>

                    <select
                        name="album_id"
                        id="album_id"
                        class="form-select @error('album_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select Album
                        </option>

                        @foreach($albums as $album)

                            <option
                                value="{{ $album->id }}"
                                {{ old('album_id', $galleryImage->album_id ?? request('album_id')) == $album->id ? 'selected' : '' }}
                            >
                                {{ $album->title }}
                            </option>

                        @endforeach

                    </select>

                    @error('album_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Image --}}
                <div class="mb-3">

                    <label for="image" class="form-label">

                        Image

                        @if(!isset($galleryImage))
                            <span class="text-danger">*</span>
                        @endif

                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp,image/gif"
                        class="form-control @error('image') is-invalid @enderror"
                        {{ !isset($galleryImage) ? 'required' : '' }}
                    >

                    <div class="form-text">
                        JPG, JPEG, PNG, WEBP or GIF. Maximum size: 5MB.
                    </div>

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Current Image --}}
                @if(isset($galleryImage) && $galleryImage->image)

                    <div class="mb-3">

                        <label class="form-label">
                            Current Image
                        </label>

                        <div>

                            <img
                                src="{{ asset('storage/' . $galleryImage->image) }}"
                                alt="{{ $galleryImage->alt_text ?? $galleryImage->title ?? 'Gallery Image' }}"
                                class="img-thumbnail"
                                style="
                                    width:220px;
                                    height:150px;
                                    object-fit:cover;
                                "
                            >

                        </div>

                        <small class="text-muted">
                            Leave the image field empty to keep the current image.
                        </small>

                    </div>

                @endif


                {{-- Image Preview --}}
                <div
                    id="imagePreviewContainer"
                    class="mb-3 d-none"
                >

                    <label class="form-label">
                        New Image Preview
                    </label>

                    <div>

                        <img
                            id="imagePreview"
                            src="#"
                            alt="Image Preview"
                            class="img-thumbnail"
                            style="
                                width:220px;
                                height:150px;
                                object-fit:cover;
                            "
                        >

                    </div>

                </div>


                {{-- Title --}}
                <div class="mb-3">

                    <label for="title" class="form-label">
                        Image Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $galleryImage->title ?? '') }}"
                        maxlength="255"
                        placeholder="Enter image title"
                    >

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ALT Text --}}
                <div class="mb-3">

                    <label for="alt_text" class="form-label">
                        SEO ALT Text
                    </label>

                    <input
                        type="text"
                        name="alt_text"
                        id="alt_text"
                        class="form-control @error('alt_text') is-invalid @enderror"
                        value="{{ old('alt_text', $galleryImage->alt_text ?? '') }}"
                        maxlength="255"
                        placeholder="Describe the image for SEO and accessibility"
                    >

                    @error('alt_text')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        Use a meaningful description of the image.
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        RIGHT COLUMN
    ========================================================== --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h6 class="mb-0">
                    <i class="bi bi-sliders me-2"></i>
                    Image Settings
                </h6>

            </div>

            <div class="card-body">

                {{-- Display Order --}}
                <div class="mb-3">

                    <label for="order" class="form-label">
                        Display Order
                    </label>

                    <input
                        type="number"
                        name="order"
                        id="order"
                        class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', $galleryImage->order ?? 0) }}"
                        min="0"
                    >

                    @error('order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        Lower numbers appear first.
                    </div>

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label for="status" class="form-label">
                        Status <span class="text-danger">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >

                        <option
                            value="1"
                            {{ old('status', $galleryImage->status ?? 1) == 1 ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('status', $galleryImage->status ?? 1) == 0 ? 'selected' : '' }}
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

            </div>

        </div>


        {{-- =====================================================
            INFORMATION CARD
        ====================================================== --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <h6 class="mb-3">

                    <i class="bi bi-info-circle me-2"></i>

                    Image Guidelines

                </h6>

                <ul class="small text-muted mb-0 ps-3">

                    <li class="mb-2">
                        Use high-quality images.
                    </li>

                    <li class="mb-2">
                        Recommended formats: JPG, PNG or WEBP.
                    </li>

                    <li class="mb-2">
                        Maximum upload size is 5MB.
                    </li>

                    <li>
                        Always provide meaningful ALT text.
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    IMAGE PREVIEW SCRIPT
============================================================= --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');

    if (!imageInput) {
        return;
    }

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {

            previewContainer.classList.add('d-none');

            preview.removeAttribute('src');

            return;
        }

        if (!file.type.startsWith('image/')) {

            previewContainer.classList.add('d-none');

            preview.removeAttribute('src');

            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

            previewContainer.classList.remove('d-none');

        };

        reader.readAsDataURL(file);

    });

});

</script>

@endpush

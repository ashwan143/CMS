{{-- =========================================================
    BASIC CONTENT
========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0">
            <i class="bi bi-card-heading me-2"></i>
            Slider Content
        </h5>
    </div>

    <div class="card-body">

        <div class="row g-3">

            {{-- Title --}}
            <div class="col-md-8">

                <label for="title" class="form-label">
                    Title <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $slider->title ?? '') }}"
                    placeholder="Enter slider title"
                    required
                >

                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Alignment --}}
            <div class="col-md-4">

                <label for="alignment" class="form-label">
                    Content Alignment
                </label>

                <select
                    name="alignment"
                    id="alignment"
                    class="form-select @error('alignment') is-invalid @enderror"
                >

                    <option
                        value="left"
                        @selected(old('alignment', $slider->alignment ?? 'left') === 'left')
                    >
                        Left
                    </option>

                    <option
                        value="center"
                        @selected(old('alignment', $slider->alignment ?? 'left') === 'center')
                    >
                        Center
                    </option>

                    <option
                        value="right"
                        @selected(old('alignment', $slider->alignment ?? 'left') === 'right')
                    >
                        Right
                    </option>

                </select>

                @error('alignment')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Subtitle --}}
            <div class="col-12">

                <label for="subtitle" class="form-label">
                    Subtitle / Description
                </label>

                <textarea
                    name="subtitle"
                    id="subtitle"
                    rows="4"
                    class="form-control @error('subtitle') is-invalid @enderror"
                    placeholder="Enter supporting slider content..."
                >{{ old('subtitle', $slider->subtitle ?? '') }}</textarea>

                @error('subtitle')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    IMAGES
========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <h5 class="mb-0">
            <i class="bi bi-images me-2"></i>
            Slider Images
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            {{-- Desktop Image --}}
            <div class="col-md-6">

                <label for="image" class="form-label">

                    Desktop / Main Image

                    @if(!isset($slider))
                        <span class="text-danger">*</span>
                    @endif

                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/webp"
                >

                <div class="form-text">
                    Recommended: 1920 × 700px.
                    JPG, PNG or WebP. Maximum 5MB.
                </div>

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                {{-- Existing Image --}}
                @if(isset($slider) && $slider->image)

                    <div class="mt-3">

                        <p class="small text-muted mb-2">
                            Current Image
                        </p>

                        <img
                            src="{{ asset('storage/' . $slider->image) }}"
                            alt="{{ $slider->title }}"
                            class="img-thumbnail"
                            style="
                                max-width:300px;
                                max-height:150px;
                                object-fit:cover;
                            "
                        >

                    </div>

                @endif


                {{-- New Image Preview --}}
                <div
                    id="imagePreviewWrapper"
                    class="mt-3 d-none"
                >

                    <p class="small text-muted mb-2">
                        New Image Preview
                    </p>

                    <img
                        id="imagePreview"
                        src="#"
                        alt="Preview"
                        class="img-thumbnail"
                        style="
                            max-width:300px;
                            max-height:150px;
                            object-fit:cover;
                        "
                    >

                </div>

            </div>


            {{-- Mobile Image --}}
            <div class="col-md-6">

                <label for="mobile_image" class="form-label">
                    Mobile Image
                </label>

                <input
                    type="file"
                    name="mobile_image"
                    id="mobile_image"
                    class="form-control @error('mobile_image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/webp"
                >

                <div class="form-text">
                    Recommended: 768 × 900px.
                    Optional mobile-specific banner.
                </div>

                @error('mobile_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror


                {{-- Existing Mobile Image --}}
                @if(isset($slider) && $slider->mobile_image)

                    <div class="mt-3">

                        <p class="small text-muted mb-2">
                            Current Mobile Image
                        </p>

                        <img
                            src="{{ asset('storage/' . $slider->mobile_image) }}"
                            alt="{{ $slider->title }}"
                            class="img-thumbnail"
                            style="
                                max-width:180px;
                                max-height:200px;
                                object-fit:cover;
                            "
                        >

                    </div>

                @endif


                {{-- Mobile Image Preview --}}
                <div
                    id="mobileImagePreviewWrapper"
                    class="mt-3 d-none"
                >

                    <p class="small text-muted mb-2">
                        New Image Preview
                    </p>

                    <img
                        id="mobileImagePreview"
                        src="#"
                        alt="Mobile Preview"
                        class="img-thumbnail"
                        style="
                            max-width:180px;
                            max-height:200px;
                            object-fit:cover;
                        "
                    >

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    PRIMARY CTA
========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <h5 class="mb-0">
            <i class="bi bi-box-arrow-up-right me-2"></i>
            Call To Action
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-3">

            {{-- Button Text --}}
            <div class="col-md-4">

                <label for="button_text" class="form-label">
                    Button Text
                </label>

                <input
                    type="text"
                    name="button_text"
                    id="button_text"
                    class="form-control @error('button_text') is-invalid @enderror"
                    value="{{ old('button_text', $slider->button_text ?? '') }}"
                    placeholder="Example: Learn More"
                >

                @error('button_text')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Button URL --}}
            <div class="col-md-5">

                <label for="button_url" class="form-label">
                    Button URL
                </label>

                <input
                    type="text"
                    name="button_url"
                    id="button_url"
                    class="form-control @error('button_url') is-invalid @enderror"
                    value="{{ old('button_url', $slider->button_url ?? '') }}"
                    placeholder="/services or https://example.com"
                >

                @error('button_url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Button Target --}}
            <div class="col-md-3">

                <label for="button_target" class="form-label">
                    Open Link
                </label>

                <select
                    name="button_target"
                    id="button_target"
                    class="form-select @error('button_target') is-invalid @enderror"
                >

                    <option
                        value="_self"
                        @selected(old('button_target', $slider->button_target ?? '_self') === '_self')
                    >
                        Same Tab
                    </option>

                    <option
                        value="_blank"
                        @selected(old('button_target', $slider->button_target ?? '_self') === '_blank')
                    >
                        New Tab
                    </option>

                </select>

                @error('button_target')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    DISPLAY & SCHEDULING
========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <h5 class="mb-0">
            <i class="bi bi-sliders me-2"></i>
            Display Settings
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-3">

            {{-- Display Order --}}
            <div class="col-md-4">

                <label for="display_order" class="form-label">
                    Display Order
                </label>

                <input
                    type="number"
                    name="display_order"
                    id="display_order"
                    min="0"
                    class="form-control @error('display_order') is-invalid @enderror"
                    value="{{ old('display_order', $slider->display_order ?? 0) }}"
                >

                <div class="form-text">
                    Lower numbers appear first.
                </div>

                @error('display_order')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Status --}}
            <div class="col-md-4">

                <label for="status" class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="form-select @error('status') is-invalid @enderror"
                >

                    <option
                        value="1"
                        @selected((string) old('status', isset($slider) ? (int) $slider->status : 1) === '1')
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected((string) old('status', isset($slider) ? (int) $slider->status : 1) === '0')
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


            {{-- Start Date --}}
            <div class="col-md-4">

                <label for="start_date" class="form-label">
                    Start Date
                </label>

                <input
                    type="datetime-local"
                    name="start_date"
                    id="start_date"
                    class="form-control @error('start_date') is-invalid @enderror"
                    value="{{ old(
                        'start_date',
                        isset($slider) && $slider->start_date
                            ? $slider->start_date->format('Y-m-d\TH:i')
                            : ''
                    ) }}"
                >

                @error('start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- End Date --}}
            <div class="col-md-4">

                <label for="end_date" class="form-label">
                    End Date
                </label>

                <input
                    type="datetime-local"
                    name="end_date"
                    id="end_date"
                    class="form-control @error('end_date') is-invalid @enderror"
                    value="{{ old(
                        'end_date',
                        isset($slider) && $slider->end_date
                            ? $slider->end_date->format('Y-m-d\TH:i')
                            : ''
                    ) }}"
                >

                @error('end_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    FORM ACTIONS
========================================================= --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <a
        href="{{ route('sliders.index') }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Cancel
    </a>

    <button
        type="submit"
        class="btn btn-primary"
    >

        <i class="bi bi-check-lg me-1"></i>

        {{ isset($slider) ? 'Update Slider' : 'Create Slider' }}

    </button>

</div>


{{-- =========================================================
    IMAGE PREVIEW SCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Desktop Image Preview
    |--------------------------------------------------------------------------
    */

    const imageInput = document.getElementById('image');

    const imagePreviewWrapper =
        document.getElementById('imagePreviewWrapper');

    const imagePreview =
        document.getElementById('imagePreview');


    if (imageInput) {

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {

                imagePreviewWrapper.classList.add('d-none');

                return;
            }


            const reader = new FileReader();


            reader.onload = function (e) {

                imagePreview.src = e.target.result;

                imagePreviewWrapper.classList.remove('d-none');

            };


            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Mobile Image Preview
    |--------------------------------------------------------------------------
    */

    const mobileImageInput =
        document.getElementById('mobile_image');

    const mobileImagePreviewWrapper =
        document.getElementById(
            'mobileImagePreviewWrapper'
        );

    const mobileImagePreview =
        document.getElementById(
            'mobileImagePreview'
        );


    if (mobileImageInput) {

        mobileImageInput.addEventListener(
            'change',
            function (event) {

                const file =
                    event.target.files[0];

                if (!file) {

                    mobileImagePreviewWrapper
                        .classList
                        .add('d-none');

                    return;
                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {

                        mobileImagePreview.src =
                            e.target.result;

                        mobileImagePreviewWrapper
                            .classList
                            .remove('d-none');

                    };


                reader.readAsDataURL(file);

            }
        );

    }

});

</script>

@endpush

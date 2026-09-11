{{-- =========================================================
    CLIENT INFORMATION
========================================================= --}}

<div class="row g-4">

    {{-- Client Name --}}
    <div class="col-md-6">

        <label for="client_name" class="form-label fw-semibold">
            Client Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="client_name"
            id="client_name"
            class="form-control @error('client_name') is-invalid @enderror"
            value="{{ old('client_name', $testimonial->client_name ?? '') }}"
            placeholder="Enter client name"
            required
        >

        @error('client_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Designation --}}
    <div class="col-md-6">

        <label for="designation" class="form-label fw-semibold">
            Designation
        </label>

        <input
            type="text"
            name="designation"
            id="designation"
            class="form-control @error('designation') is-invalid @enderror"
            value="{{ old('designation', $testimonial->designation ?? '') }}"
            placeholder="CEO, Founder, Director..."
        >

        @error('designation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Company Name --}}
    <div class="col-md-6">

        <label for="company_name" class="form-label fw-semibold">
            Company / Organization
        </label>

        <input
            type="text"
            name="company_name"
            id="company_name"
            class="form-control @error('company_name') is-invalid @enderror"
            value="{{ old('company_name', $testimonial->company_name ?? '') }}"
            placeholder="Enter company name"
        >

        @error('company_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Project --}}
    <div class="col-md-6">

        <label for="project_id" class="form-label fw-semibold">
            Related Project
        </label>

        <select
            name="project_id"
            id="project_id"
            class="form-select @error('project_id') is-invalid @enderror"
        >

            <option value="">
                Select Project
            </option>

            @foreach($projects as $project)

                <option
                    value="{{ $project->id }}"
                    {{ old('project_id', $testimonial->project_id ?? '') == $project->id ? 'selected' : '' }}
                >
                    {{ $project->title }}
                </option>

            @endforeach

        </select>

        @error('project_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =========================================================
        TESTIMONIAL CONTENT
    ========================================================== --}}

    <div class="col-12">

        <label for="testimonial" class="form-label fw-semibold">
            Testimonial <span class="text-danger">*</span>
        </label>

        <textarea
            name="testimonial"
            id="testimonial"
            rows="6"
            class="form-control @error('testimonial') is-invalid @enderror"
            placeholder="Enter client's testimonial..."
            required
        >{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>

        <div class="form-text">
            Write the complete client review or feedback.
        </div>

        @error('testimonial')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =========================================================
        RATING
    ========================================================== --}}

    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Rating <span class="text-danger">*</span>
        </label>

        @php
            $selectedRating = old(
                'rating',
                $testimonial->rating ?? 5
            );
        @endphp

        <div
            class="d-flex gap-2 align-items-center"
            id="rating-selector"
        >

            @for($i = 1; $i <= 5; $i++)

                <button
                    type="button"
                    class="btn btn-sm rating-star"
                    data-rating="{{ $i }}"
                    style="font-size:1.5rem;"
                >

                    <i class="bi {{ $i <= $selectedRating ? 'bi-star-fill text-warning' : 'bi-star text-secondary' }}"></i>

                </button>

            @endfor

            <span
                id="rating-text"
                class="ms-2 text-muted"
            >
                {{ $selectedRating }} / 5
            </span>

        </div>

        <input
            type="hidden"
            name="rating"
            id="rating"
            value="{{ $selectedRating }}"
        >

        @error('rating')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Display Order --}}
    <div class="col-md-6">

        <label for="display_order" class="form-label fw-semibold">
            Display Order
        </label>

        <input
            type="number"
            name="display_order"
            id="display_order"
            min="0"
            class="form-control @error('display_order') is-invalid @enderror"
            value="{{ old('display_order', $testimonial->display_order ?? 0) }}"
            placeholder="0"
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


    {{-- =========================================================
        CLIENT PHOTO
    ========================================================== --}}

    <div class="col-md-6">

        <label for="client_photo" class="form-label fw-semibold">
            Client Photo
        </label>

        <input
            type="file"
            name="client_photo"
            id="client_photo"
            class="form-control @error('client_photo') is-invalid @enderror"
            accept="image/jpeg,image/png,image/webp"
        >

        <div class="form-text">
            JPG, PNG or WEBP. Maximum 2MB.
        </div>

        @error('client_photo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror


        {{-- Preview --}}
        <div class="mt-3">

            <img
                id="client-photo-preview"
                src="{{ !empty($testimonial?->client_photo)
                    ? asset('storage/' . $testimonial->client_photo)
                    : '' }}"
                alt="Client Photo Preview"
                class="{{ !empty($testimonial?->client_photo) ? '' : 'd-none' }} rounded-circle border"
                width="100"
                height="100"
                style="object-fit:cover;"
            >

        </div>

    </div>


    {{-- =========================================================
        COMPANY LOGO
    ========================================================== --}}

    <div class="col-md-6">

        <label for="company_logo" class="form-label fw-semibold">
            Company Logo
        </label>

        <input
            type="file"
            name="company_logo"
            id="company_logo"
            class="form-control @error('company_logo') is-invalid @enderror"
            accept="image/jpeg,image/png,image/webp"
        >

        <div class="form-text">
            JPG, PNG or WEBP. Maximum 2MB.
        </div>

        @error('company_logo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror


        {{-- Preview --}}
        <div class="mt-3">

            <img
                id="company-logo-preview"
                src="{{ !empty($testimonial?->company_logo)
                    ? asset('storage/' . $testimonial->company_logo)
                    : '' }}"
                alt="Company Logo Preview"
                class="{{ !empty($testimonial?->company_logo) ? '' : 'd-none' }} border rounded p-2"
                width="160"
                height="80"
                style="object-fit:contain;"
            >

        </div>

    </div>


    {{-- =========================================================
        IMAGE ALT TEXT
    ========================================================== --}}

    <div class="col-md-6">

        <label for="photo_alt" class="form-label fw-semibold">
            Client Photo ALT Text
        </label>

        <input
            type="text"
            name="photo_alt"
            id="photo_alt"
            class="form-control @error('photo_alt') is-invalid @enderror"
            value="{{ old('photo_alt', $testimonial->photo_alt ?? '') }}"
            placeholder="Example: Rahul Sharma"
        >

        @error('photo_alt')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    <div class="col-md-6">

        <label for="logo_alt" class="form-label fw-semibold">
            Company Logo ALT Text
        </label>

        <input
            type="text"
            name="logo_alt"
            id="logo_alt"
            class="form-control @error('logo_alt') is-invalid @enderror"
            value="{{ old('logo_alt', $testimonial->logo_alt ?? '') }}"
            placeholder="Example: ABC Technologies Logo"
        >

        @error('logo_alt')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =========================================================
        PUBLISHING
    ========================================================== --}}

    <div class="col-md-4">

        <label for="status" class="form-label fw-semibold">
            Status
        </label>

        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
        >

            <option
                value="1"
                {{ old('status', $testimonial->status ?? 1) == 1 ? 'selected' : '' }}
            >
                Active
            </option>

            <option
                value="0"
                {{ old('status', $testimonial->status ?? 1) == 0 ? 'selected' : '' }}
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


    <div class="col-md-4">

        <label for="is_featured" class="form-label fw-semibold">
            Homepage Featured
        </label>

        <select
            name="is_featured"
            id="is_featured"
            class="form-select @error('is_featured') is-invalid @enderror"
        >

            <option
                value="0"
                {{ old('is_featured', $testimonial->is_featured ?? 0) == 0 ? 'selected' : '' }}
            >
                No
            </option>

            <option
                value="1"
                {{ old('is_featured', $testimonial->is_featured ?? 0) == 1 ? 'selected' : '' }}
            >
                Yes
            </option>

        </select>

        @error('is_featured')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    <div class="col-md-4">

        <label for="published_at" class="form-label fw-semibold">
            Published At
        </label>

        <input
            type="datetime-local"
            name="published_at"
            id="published_at"
            class="form-control @error('published_at') is-invalid @enderror"
            value="{{ old(
                'published_at',
                !empty($testimonial?->published_at)
                    ? $testimonial->published_at->format('Y-m-d\TH:i')
                    : ''
            ) }}"
        >

        @error('published_at')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Rating Selector
    |--------------------------------------------------------------------------
    */

    const ratingInput = document.getElementById('rating');
    const ratingText = document.getElementById('rating-text');
    const ratingStars = document.querySelectorAll('.rating-star');

    function updateRating(rating) {

        ratingInput.value = rating;
        ratingText.textContent = rating + ' / 5';

        ratingStars.forEach(function (button) {

            const star = button.querySelector('i');
            const value = parseInt(button.dataset.rating);

            if (value <= rating) {

                star.className =
                    'bi bi-star-fill text-warning';

            } else {

                star.className =
                    'bi bi-star text-secondary';

            }

        });

    }

    ratingStars.forEach(function (button) {

        button.addEventListener('click', function () {

            updateRating(
                parseInt(this.dataset.rating)
            );

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Client Photo Preview
    |--------------------------------------------------------------------------
    */

    const clientPhoto =
        document.getElementById('client_photo');

    const clientPreview =
        document.getElementById('client-photo-preview');

    if (clientPhoto) {

        clientPhoto.addEventListener('change', function () {

            if (this.files && this.files[0]) {

                const reader = new FileReader();

                reader.onload = function (event) {

                    clientPreview.src =
                        event.target.result;

                    clientPreview.classList.remove(
                        'd-none'
                    );

                };

                reader.readAsDataURL(
                    this.files[0]
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Company Logo Preview
    |--------------------------------------------------------------------------
    */

    const companyLogo =
        document.getElementById('company_logo');

    const companyPreview =
        document.getElementById('company-logo-preview');

    if (companyLogo) {

        companyLogo.addEventListener('change', function () {

            if (this.files && this.files[0]) {

                const reader = new FileReader();

                reader.onload = function (event) {

                    companyPreview.src =
                        event.target.result;

                    companyPreview.classList.remove(
                        'd-none'
                    );

                };

                reader.readAsDataURL(
                    this.files[0]
                );

            }

        });

    }

});

</script>

@endpush

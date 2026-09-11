<div class="row">

    {{-- ========================================= --}}
    {{-- LEFT COLUMN --}}
    {{-- ========================================= --}}

    <div class="col-lg-8">

        {{-- Technology Information --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Technology Information
                </h5>

            </div>

            <div class="card-body">

                {{-- Technology Name --}}
                <div class="mb-3">

                    <label for="name"
                           class="form-label">

                        Technology Name
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $technology->name ?? '') }}"
                        placeholder="Example: Laravel"
                        required
                    >

                    @error('name')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Slug --}}
                <div class="mb-3">

                    <label for="slug"
                           class="form-label">

                        Slug

                    </label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $technology->slug ?? '') }}"
                        placeholder="laravel"
                    >

                    <small class="text-muted">
                        Leave empty to generate automatically from the technology name.
                    </small>

                    @error('slug')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label for="description"
                           class="form-label">

                        Description

                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="8"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Write a short description about this technology..."
                    >{{ old('description', $technology->description ?? '') }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- RIGHT COLUMN --}}
    {{-- ========================================= --}}

    <div class="col-lg-4">


        {{-- Technology Icon --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Technology Icon
                </h5>

            </div>

            <div class="card-body">

                {{-- Existing Icon --}}
                @if(isset($technology) && $technology->icon)

                    <div class="text-center mb-3">

                        <img
                            src="{{ asset('storage/' . $technology->icon) }}"
                            alt="{{ $technology->name }}"
                            class="img-fluid border rounded p-2"
                            style="width:120px;height:120px;object-fit:contain;"
                        >

                    </div>

                @endif


                <div class="mb-3">

                    <label for="icon"
                           class="form-label">

                        Icon

                    </label>

                    <input
                        type="file"
                        name="icon"
                        id="icon"
                        class="form-control @error('icon') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/webp,image/svg+xml"
                    >

                    <small class="text-muted">
                        JPG, PNG, WEBP or SVG. Maximum 2MB.
                    </small>

                    @error('icon')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Preview --}}
                <div
                    id="iconPreview"
                    class="text-center mt-3"
                ></div>

            </div>

        </div>


        {{-- Settings --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Settings
                </h5>

            </div>

            <div class="card-body">

                {{-- Display Order --}}
                <div class="mb-3">

                    <label for="order"
                           class="form-label">

                        Display Order

                    </label>

                    <input
                        type="number"
                        name="order"
                        id="order"
                        class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', $technology->order ?? 0) }}"
                        min="0"
                    >

                    @error('order')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label for="status"
                           class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                    >

                        <option value="1"
                            {{ old('status', $technology->status ?? 1) == 1 ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="0"
                            {{ old('status', $technology->status ?? 1) == 0 ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- Save Button --}}
        <div class="card shadow-sm border-0">

            <div class="card-body">

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >

                    <i class="bi bi-check-lg"></i>

                    {{ isset($technology) ? 'Update Technology' : 'Save Technology' }}

                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- ICON PREVIEW --}}
{{-- ========================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const iconInput = document.getElementById('icon');
    const preview = document.getElementById('iconPreview');

    if (!iconInput || !preview) {
        return;
    }

    iconInput.addEventListener('change', function (event) {

        preview.innerHTML = '';

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const image = document.createElement('img');

        image.src = URL.createObjectURL(file);

        image.classList.add(
            'img-fluid',
            'border',
            'rounded',
            'p-2'
        );

        image.style.width = '120px';
        image.style.height = '120px';
        image.style.objectFit = 'contain';

        preview.appendChild(image);

    });

});

</script>

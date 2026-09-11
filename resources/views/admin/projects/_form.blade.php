<div class="row">

    {{-- ========================================= --}}
    {{-- LEFT COLUMN --}}
    {{-- ========================================= --}}

    <div class="col-lg-8">

        {{-- Project Information --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Project Information
                </h5>

            </div>

            <div class="card-body">


                {{-- Title --}}
                <div class="mb-3">

                    <label for="title"
                           class="form-label">

                        Project Title
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $project->title ?? '') }}"
                        placeholder="Example: Hospital Management System"
                        required
                    >

                    @error('title')

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
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $project->slug ?? '') }}"
                        placeholder="hospital-management-system"
                        required
                    >

                    <small class="text-muted">
                        Example:
                        hospital-management-system
                    </small>

                    @error('slug')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Short Description --}}
                <div class="mb-3">

                    <label for="short_description"
                           class="form-label">

                        Short Description

                    </label>

                    <textarea
                        name="short_description"
                        id="short_description"
                        rows="3"
                        class="form-control @error('short_description') is-invalid @enderror"
                        placeholder="Write a short description of the project..."
                    >{{ old('short_description', $project->short_description ?? '') }}</textarea>

                    @error('short_description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Full Description --}}
                <div class="mb-3">

                    <label for="description"
                           class="form-label">

                        Project Description

                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="10"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Write complete project details..."
                    >{{ old('description', $project->description ?? '') }}</textarea>

                    @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- Client Information --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Client Information
                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label for="client_name"
                           class="form-label">

                        Client Name

                    </label>

                    <input
                        type="text"
                        name="client_name"
                        id="client_name"
                        class="form-control @error('client_name') is-invalid @enderror"
                        value="{{ old('client_name', $project->client_name ?? '') }}"
                        placeholder="Example: ABC Healthcare Pvt. Ltd."
                    >

                    @error('client_name')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- Project Link --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Project Link
                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label for="project_url"
                           class="form-label">

                        Live Project URL

                    </label>

                    <input
                        type="url"
                        name="project_url"
                        id="project_url"
                        class="form-control @error('project_url') is-invalid @enderror"
                        value="{{ old('project_url', $project->project_url ?? '') }}"
                        placeholder="https://example.com"
                    >

                    @error('project_url')

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


        {{-- Project Settings --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Project Settings
                </h5>

            </div>

            <div class="card-body">


                {{-- Category --}}
                <div class="mb-3">

                    <label for="category"
                           class="form-label">

                        Category

                    </label>

                    <input
                        type="text"
                        name="category"
                        id="category"
                        class="form-control @error('category') is-invalid @enderror"
                        value="{{ old('category', $project->category ?? '') }}"
                        placeholder="Web Development"
                    >

                    @error('category')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Completion Date --}}
                <div class="mb-3">

                    <label for="completion_date"
                           class="form-label">

                        Completion Date

                    </label>

                    <input
                        type="date"
                        name="completion_date"
                        id="completion_date"
                        class="form-control @error('completion_date') is-invalid @enderror"
                        value="{{ old('completion_date', $project->completion_date ?? '') }}"
                    >

                    @error('completion_date')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Display Order --}}
                <div class="mb-3">

                    <label for="display_order"
                           class="form-label">

                        Display Order

                    </label>

                    <input
                        type="number"
                        name="display_order"
                        id="display_order"
                        class="form-control @error('display_order') is-invalid @enderror"
                        value="{{ old('display_order', $project->display_order ?? 0) }}"
                        min="0"
                    >

                    @error('display_order')

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
                            {{ old('status', $project->status ?? 1) == 1 ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="0"
                            {{ old('status', $project->status ?? 1) == 0 ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- Featured Image --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Project Image
                </h5>

            </div>

            <div class="card-body">

                {{-- Existing Image --}}
                @if(isset($project) && $project->image)

                    <div class="mb-3">

                        <img
                            src="{{ asset('storage/' . $project->image) }}"
                            alt="{{ $project->title }}"
                            class="img-fluid rounded"
                            style="max-height: 180px;"
                        >

                    </div>

                @endif


                <div class="mb-3">

                    <label for="image"
                           class="form-label">

                        Featured Image

                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small class="text-muted">
                        JPG, PNG or WEBP. Maximum 2MB.
                    </small>

                    @error('image')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Image Preview --}}
                <div id="imagePreview"
                     class="mt-3">
                </div>

            </div>

        </div>


        {{-- Submit --}}
        <div class="card shadow-sm border-0">

            <div class="card-body">

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >

                    <i class="bi bi-check-lg"></i>

                    {{ isset($project) ? 'Update Project' : 'Save Project' }}

                </button>

            </div>

        </div>

    </div>

</div>


{{-- Image Preview --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const preview = document.getElementById('imagePreview');

    if (!imageInput || !preview) {
        return;
    }

    imageInput.addEventListener('change', function (event) {

        preview.innerHTML = '';

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const image = document.createElement('img');

        image.src = URL.createObjectURL(file);

        image.classList.add('img-fluid', 'rounded');

        image.style.maxHeight = '180px';

        preview.appendChild(image);

    });

});

</script>

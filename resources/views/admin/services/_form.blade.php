<div class="row">

    <!-- Left Column -->
    <div class="col-lg-8">

        <!-- Basic Information -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Basic Information</h5>
            </div>

            <div class="card-body">

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Service Title <span class="text-danger">*</span></label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $service->title ?? '') }}"
                        placeholder="Enter service title">

                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label">Slug</label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $service->slug ?? '') }}"
                        placeholder="Auto Generated">

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label class="form-label">Short Description</label>

                    <textarea
                        name="short_description"
                        rows="3"
                        class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $service->short_description ?? '') }}</textarea>

                    @error('short_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        id="description"
                        rows="8"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description ?? '') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>
        </div>

        <!-- SEO -->
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">SEO Information</h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">SEO Title</label>

                    <input
                        type="text"
                        name="seo_title"
                        class="form-control"
                        value="{{ old('seo_title', $service->seo_title ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">SEO Keywords</label>

                    <input
                        type="text"
                        name="seo_keywords"
                        class="form-control"
                        value="{{ old('seo_keywords', $service->seo_keywords ?? '') }}">
                </div>

                <div class="mb-0">
                    <label class="form-label">SEO Description</label>

                    <textarea
                        name="seo_description"
                        rows="4"
                        class="form-control">{{ old('seo_description', $service->seo_description ?? '') }}</textarea>
                </div>

            </div>

        </div>

    </div>

    <!-- Right Column -->
    <div class="col-lg-4">

        <!-- Image -->
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">Service Image</h5>
            </div>

            <div class="card-body">

                <input
                    type="file"
                    name="image"
                    class="form-control">

                <small class="text-muted">
                    JPG, PNG, WEBP
                </small>

            </div>

        </div>

        <!-- Settings -->
        <div class="card shadow-sm">

            <div class="card-header">
                <h5 class="mb-0">Settings</h5>
            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="1"
                            {{ old('status', $service->status ?? 1) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('status', $service->status ?? 1) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Display Order</label>

                    <input
                        type="number"
                        name="display_order"
                        class="form-control"
                        value="{{ old('display_order', $service->display_order ?? 0) }}">

                </div>

                <div>

                    <label class="form-label">Bootstrap Icon</label>

                    <input
                        type="text"
                        name="icon"
                        class="form-control"
                        placeholder="bi bi-code-slash"
                        value="{{ old('icon', $service->icon ?? '') }}">

                </div>

            </div>

        </div>

    </div>

</div>

<div class="mt-4">

    <button class="btn btn-primary">
        <i class="bi bi-check-circle"></i>
        Save Service
    </button>

    <a href="{{ route('services.index') }}"
       class="btn btn-secondary">
        Cancel
    </a>

</div>

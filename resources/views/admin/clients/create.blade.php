@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Add Client</h1>
            <p class="text-muted mb-0">Create a new client.</p>
        </div>

        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
            Back to Clients
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Client Name --}}
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Client Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug') }}"
                            placeholder="client-name"
                        >

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Industry --}}
                    <div class="col-md-6 mb-3">
                        <label for="industry" class="form-label">
                            Industry
                        </label>

                        <input
                            type="text"
                            name="industry"
                            id="industry"
                            class="form-control @error('industry') is-invalid @enderror"
                            value="{{ old('industry') }}"
                        >

                        @error('industry')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div class="col-md-6 mb-3">
                        <label for="website" class="form-label">
                            Website
                        </label>

                        <input
                            type="url"
                            name="website"
                            id="website"
                            class="form-control @error('website') is-invalid @enderror"
                            value="{{ old('website') }}"
                            placeholder="https://example.com"
                        >

                        @error('website')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="col-md-6 mb-3">
                        <label for="logo" class="form-label">
                            Client Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            id="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </small>

                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Display Order --}}
                    <div class="col-md-3 mb-3">
                        <label for="order" class="form-label">
                            Display Order
                        </label>

                        <input
                            type="number"
                            name="order"
                            id="order"
                            class="form-control @error('order') is-invalid @enderror"
                            value="{{ old('order', 0) }}"
                            min="0"
                        >

                        @error('order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label d-block">
                            Status
                        </label>

                        <div class="form-check form-switch mt-2">
                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                {{ old('status', 1) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="status">
                                Active
                            </label>
                        </div>
                    </div>

                    {{-- Featured --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label d-block">
                            Featured
                        </label>

                        <div class="form-check form-switch mt-2">
                            <input
                                type="hidden"
                                name="is_featured"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_featured"
                                id="is_featured"
                                value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="is_featured">
                                Featured Client
                            </label>
                        </div>
                    </div>

                    {{-- Short Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="short_description" class="form-label">
                            Short Description
                        </label>

                        <textarea
                            name="short_description"
                            id="short_description"
                            rows="3"
                            class="form-control @error('short_description') is-invalid @enderror"
                        >{{ old('short_description') }}</textarea>

                        @error('short_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- SEO Title --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_title" class="form-label">
                            SEO Title
                        </label>

                        <input
                            type="text"
                            name="seo_title"
                            id="seo_title"
                            class="form-control @error('seo_title') is-invalid @enderror"
                            value="{{ old('seo_title') }}"
                        >

                        @error('seo_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- SEO Keywords --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_keywords" class="form-label">
                            SEO Keywords
                        </label>

                        <textarea
                            name="seo_keywords"
                            id="seo_keywords"
                            rows="2"
                            class="form-control @error('seo_keywords') is-invalid @enderror"
                            placeholder="software, solutions, client"
                        >{{ old('seo_keywords') }}</textarea>

                        @error('seo_keywords')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- SEO Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_description" class="form-label">
                            SEO Description
                        </label>

                        <textarea
                            name="seo_description"
                            id="seo_description"
                            rows="3"
                            class="form-control @error('seo_description') is-invalid @enderror"
                        >{{ old('seo_description') }}</textarea>

                        @error('seo_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Save Client
                    </button>

                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

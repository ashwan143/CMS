@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Add Team Member</h1>
            <p class="text-muted mb-0">Create a new team member.</p>
        </div>

        <a href="{{ route('team-members.index') }}" class="btn btn-secondary">
            Back to Team Members
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form
                action="{{ route('team-members.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="row">

                    {{-- Name --}}
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Name <span class="text-danger">*</span>
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

                    {{-- Designation --}}
                    <div class="col-md-6 mb-3">
                        <label for="designation" class="form-label">
                            Designation
                        </label>

                        <input
                            type="text"
                            name="designation"
                            id="designation"
                            class="form-control @error('designation') is-invalid @enderror"
                            value="{{ old('designation') }}"
                            placeholder="CEO, Developer, Project Manager"
                        >

                        @error('designation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Profile Image --}}
                    <div class="col-md-6 mb-3">
                        <label for="profile_image" class="form-label">
                            Profile Image
                        </label>

                        <input
                            type="file"
                            name="profile_image"
                            id="profile_image"
                            class="form-control @error('profile_image') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </small>

                        @error('profile_image')
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

                    {{-- Biography --}}
                    <div class="col-md-12 mb-3">
                        <label for="bio" class="form-label">
                            Biography
                        </label>

                        <textarea
                            name="bio"
                            id="bio"
                            rows="7"
                            class="form-control @error('bio') is-invalid @enderror"
                        >{{ old('bio') }}</textarea>

                        @error('bio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- LinkedIn --}}
                    <div class="col-md-4 mb-3">
                        <label for="linkedin" class="form-label">
                            LinkedIn URL
                        </label>

                        <input
                            type="url"
                            name="social_links[linkedin]"
                            id="linkedin"
                            class="form-control @error('social_links.linkedin') is-invalid @enderror"
                            value="{{ old('social_links.linkedin') }}"
                            placeholder="https://linkedin.com/in/example"
                        >

                        @error('social_links.linkedin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Facebook --}}
                    <div class="col-md-4 mb-3">
                        <label for="facebook" class="form-label">
                            Facebook URL
                        </label>

                        <input
                            type="url"
                            name="social_links[facebook]"
                            id="facebook"
                            class="form-control @error('social_links.facebook') is-invalid @enderror"
                            value="{{ old('social_links.facebook') }}"
                            placeholder="https://facebook.com/example"
                        >

                        @error('social_links.facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Instagram --}}
                    <div class="col-md-4 mb-3">
                        <label for="instagram" class="form-label">
                            Instagram URL
                        </label>

                        <input
                            type="url"
                            name="social_links[instagram]"
                            id="instagram"
                            class="form-control @error('social_links.instagram') is-invalid @enderror"
                            value="{{ old('social_links.instagram') }}"
                            placeholder="https://instagram.com/example"
                        >

                        @error('social_links.instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Save Team Member
                    </button>

                    <a
                        href="{{ route('team-members.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

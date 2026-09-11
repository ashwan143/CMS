@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Add Job Opening</h1>
            <p class="text-muted mb-0">Create a new job opening.</p>
        </div>

        <a href="{{ route('job-openings.index') }}" class="btn btn-secondary">
            Back to Job Openings
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('job-openings.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Job Title --}}
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">
                            Job Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            required
                        >

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            placeholder="senior-laravel-developer"
                        >

                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-4 mb-3">
                        <label for="department" class="form-label">
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            id="department"
                            class="form-control @error('department') is-invalid @enderror"
                            value="{{ old('department') }}"
                            placeholder="Development"
                        >

                        @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div class="col-md-4 mb-3">
                        <label for="location" class="form-label">
                            Location
                        </label>

                        <input
                            type="text"
                            name="location"
                            id="location"
                            class="form-control @error('location') is-invalid @enderror"
                            value="{{ old('location') }}"
                            placeholder="Remote / Mumbai / Bangalore"
                        >

                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Employment Type --}}
                    <div class="col-md-4 mb-3">
                        <label for="employment_type" class="form-label">
                            Employment Type
                        </label>

                        <select
                            name="employment_type"
                            id="employment_type"
                            class="form-select @error('employment_type') is-invalid @enderror"
                        >
                            <option value="">Select Type</option>
                            <option value="Full Time" {{ old('employment_type') == 'Full Time' ? 'selected' : '' }}>
                                Full Time
                            </option>
                            <option value="Part Time" {{ old('employment_type') == 'Part Time' ? 'selected' : '' }}>
                                Part Time
                            </option>
                            <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>
                                Contract
                            </option>
                            <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>
                                Internship
                            </option>
                        </select>

                        @error('employment_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Experience --}}
                    <div class="col-md-6 mb-3">
                        <label for="experience" class="form-label">
                            Experience
                        </label>

                        <input
                            type="text"
                            name="experience"
                            id="experience"
                            class="form-control @error('experience') is-invalid @enderror"
                            value="{{ old('experience') }}"
                            placeholder="2-4 Years"
                        >

                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-6 mb-3">
                        <label for="salary" class="form-label">
                            Salary
                        </label>

                        <input
                            type="text"
                            name="salary"
                            id="salary"
                            class="form-control @error('salary') is-invalid @enderror"
                            value="{{ old('salary') }}"
                            placeholder="₹5,00,000 - ₹8,00,000"
                        >

                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Application Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="application_email" class="form-label">
                            Application Email
                        </label>

                        <input
                            type="email"
                            name="application_email"
                            id="application_email"
                            class="form-control @error('application_email') is-invalid @enderror"
                            value="{{ old('application_email') }}"
                            placeholder="careers@example.com"
                        >

                        @error('application_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deadline --}}
                    <div class="col-md-3 mb-3">
                        <label for="deadline" class="form-label">
                            Application Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            id="deadline"
                            class="form-control @error('deadline') is-invalid @enderror"
                            value="{{ old('deadline') }}"
                        >

                        @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
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
                                Featured Job
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
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">
                            Job Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Requirements --}}
                    <div class="col-md-12 mb-3">
                        <label for="requirements" class="form-label">
                            Requirements
                        </label>

                        <textarea
                            name="requirements"
                            id="requirements"
                            rows="6"
                            class="form-control @error('requirements') is-invalid @enderror"
                            placeholder="Enter required skills, qualifications and experience."
                        >{{ old('requirements') }}</textarea>

                        @error('requirements')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Responsibilities --}}
                    <div class="col-md-12 mb-3">
                        <label for="responsibilities" class="form-label">
                            Responsibilities
                        </label>

                        <textarea
                            name="responsibilities"
                            id="responsibilities"
                            rows="6"
                            class="form-control @error('responsibilities') is-invalid @enderror"
                            placeholder="Enter job responsibilities."
                        >{{ old('responsibilities') }}</textarea>

                        @error('responsibilities')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            placeholder="jobs, careers, software developer"
                        >{{ old('seo_keywords') }}</textarea>

                        @error('seo_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Save Job Opening
                    </button>

                    <a
                        href="{{ route('job-openings.index') }}"
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

@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Job Opening Details</h1>
            <p class="text-muted mb-0">View job opening information.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('job-openings.edit', $jobOpening) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('job-openings.index') }}" class="btn btn-secondary">
                Back to Job Openings
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h3>{{ $jobOpening->title }}</h3>

            <div class="mt-2 mb-4">

                @if($jobOpening->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif

                @if($jobOpening->is_featured)
                    <span class="badge bg-warning text-dark">Featured</span>
                @endif

            </div>

            <hr>

            <div class="row mb-4">

                <div class="col-md-4 mb-3">
                    <strong>Department</strong>
                    <div>{{ $jobOpening->department ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Location</strong>
                    <div>{{ $jobOpening->location ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Employment Type</strong>
                    <div>{{ $jobOpening->employment_type ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Experience</strong>
                    <div>{{ $jobOpening->experience ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Salary</strong>
                    <div>{{ $jobOpening->salary ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Display Order</strong>
                    <div>{{ $jobOpening->order }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Application Email</strong>
                    <div>{{ $jobOpening->application_email ?? '-' }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Deadline</strong>
                    <div>
                        @if($jobOpening->deadline)
                            {{ $jobOpening->deadline->format('d M Y') }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Slug</strong>
                    <div>{{ $jobOpening->slug ?? '-' }}</div>
                </div>

            </div>

            {{-- Short Description --}}
            <div class="mb-4">
                <h5>Short Description</h5>

                @if($jobOpening->short_description)
                    <p>{{ $jobOpening->short_description }}</p>
                @else
                    <p class="text-muted">No short description.</p>
                @endif
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <h5>Job Description</h5>

                @if($jobOpening->description)
                    <div>{!! nl2br(e($jobOpening->description)) !!}</div>
                @else
                    <p class="text-muted">No description.</p>
                @endif
            </div>

            {{-- Requirements --}}
            <div class="mb-4">
                <h5>Requirements</h5>

                @if($jobOpening->requirements)
                    <div>{!! nl2br(e($jobOpening->requirements)) !!}</div>
                @else
                    <p class="text-muted">No requirements provided.</p>
                @endif
            </div>

            {{-- Responsibilities --}}
            <div class="mb-4">
                <h5>Responsibilities</h5>

                @if($jobOpening->responsibilities)
                    <div>{!! nl2br(e($jobOpening->responsibilities)) !!}</div>
                @else
                    <p class="text-muted">No responsibilities provided.</p>
                @endif
            </div>

            {{-- SEO --}}
            <div>
                <h5>SEO Information</h5>

                <p>
                    <strong>SEO Title:</strong>
                    {{ $jobOpening->seo_title ?? '-' }}
                </p>

                <p>
                    <strong>SEO Keywords:</strong>
                    {{ $jobOpening->seo_keywords ?? '-' }}
                </p>

                <p>
                    <strong>SEO Description:</strong>
                    {{ $jobOpening->seo_description ?? '-' }}
                </p>
            </div>

        </div>
    </div>

</div>

@endsection

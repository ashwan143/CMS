@extends('admin.layouts.app')

@section('title', 'Project Details')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Project Details</h2>

            <p class="text-muted mb-0">
                View complete project information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('projects.edit', $project) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>

            <a href="{{ route('projects.index') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </div>


    <div class="row">


        {{-- ========================================= --}}
        {{-- LEFT COLUMN --}}
        {{-- ========================================= --}}

        <div class="col-lg-8">


            {{-- Project Overview --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Project Overview
                    </h5>

                </div>

                <div class="card-body">


                    {{-- Project Image --}}
                    @if($project->image)

                        <div class="mb-4 text-center">

                            <img
                                src="{{ asset('storage/' . $project->image) }}"
                                alt="{{ $project->title }}"
                                class="img-fluid rounded"
                                style="max-height: 400px;"
                            >

                        </div>

                    @endif


                    {{-- Title --}}
                    <h3 class="mb-2">

                        {{ $project->title }}

                    </h3>


                    {{-- Short Description --}}
                    @if($project->short_description)

                        <p class="text-muted fs-5">

                            {{ $project->short_description }}

                        </p>

                    @endif


                    <hr>


                    {{-- Full Description --}}
                    <div>

                        <h5 class="mb-3">
                            Project Description
                        </h5>

                        @if($project->description)

                            <div class="text-muted">

                                {!! nl2br(e($project->description)) !!}

                            </div>

                        @else

                            <p class="text-muted">
                                No description available.
                            </p>

                        @endif

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

                    <div class="row">

                        <div class="col-md-6">

                            <small class="text-muted">
                                Client Name
                            </small>

                            <div class="fw-semibold mt-1">

                                {{ $project->client_name ?? 'Not specified' }}

                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Project URL
                            </small>

                            <div class="mt-1">

                                @if($project->project_url)

                                    <a
                                        href="{{ $project->project_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >

                                        {{ $project->project_url }}

                                        <i class="bi bi-box-arrow-up-right"></i>

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Not specified
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>


        {{-- ========================================= --}}
        {{-- RIGHT COLUMN --}}
        {{-- ========================================= --}}

        <div class="col-lg-4">


            {{-- Project Information --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Project Information
                    </h5>

                </div>

                <div class="card-body">


                    {{-- Category --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Category
                        </small>

                        @if($project->category)

                            <span class="badge bg-light text-dark border mt-1">

                                {{ $project->category }}

                            </span>

                        @else

                            <span class="text-muted">
                                Not specified
                            </span>

                        @endif

                    </div>


                    {{-- Completion Date --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Completion Date
                        </small>

                        <div class="mt-1">

                            @if($project->completion_date)

                                {{ \Carbon\Carbon::parse($project->completion_date)->format('d M Y') }}

                            @else

                                <span class="text-muted">
                                    Not specified
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Display Order --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Display Order
                        </small>

                        <div class="mt-1">

                            {{ $project->display_order }}

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Status
                        </small>

                        <div class="mt-1">

                            @if($project->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Slug --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Slug
                        </small>

                        <code>
                            {{ $project->slug }}
                        </code>

                    </div>

                </div>

            </div>


            {{-- Created Information --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Record Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created By
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $project->creator->name ?? 'System' }}

                        </div>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created At
                        </small>

                        <div class="mt-1">

                            {{ $project->created_at->format('d M Y, h:i A') }}

                        </div>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Last Updated
                        </small>

                        <div class="mt-1">

                            {{ $project->updated_at->format('d M Y, h:i A') }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- Delete --}}
            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <form
                        action="{{ route('projects.destroy', $project) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this project?');"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger w-100"
                        >

                            <i class="bi bi-trash"></i>
                            Delete Project

                        </button>

                    </form>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection

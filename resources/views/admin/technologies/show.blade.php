@extends('admin.layouts.app')

@section('title', 'Technology Details')

@section('content')

<div class="container-fluid">

    {{-- ========================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Technology Details
            </h2>

            <p class="text-muted mb-0">
                View technology information and related projects.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('technologies.edit', $technology) }}"
                class="btn btn-warning"
            >

                <i class="bi bi-pencil"></i>
                Edit

            </a>


            <a
                href="{{ route('technologies.index') }}"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </div>


    <div class="row">


        {{-- ========================================= --}}
        {{-- TECHNOLOGY INFORMATION --}}
        {{-- ========================================= --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Technology Information
                    </h5>

                </div>


                <div class="card-body text-center">


                    {{-- Icon --}}
                    @if($technology->icon)

                        <img
                            src="{{ asset('storage/' . $technology->icon) }}"
                            alt="{{ $technology->name }}"
                            class="img-fluid border rounded p-2 mb-4"
                            style="
                                width:140px;
                                height:140px;
                                object-fit:contain;
                            "
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center bg-light border rounded mx-auto mb-4"
                            style="
                                width:140px;
                                height:140px;
                            "
                        >

                            <i
                                class="bi bi-code-square text-muted"
                                style="font-size:4rem;"
                            ></i>

                        </div>

                    @endif


                    {{-- Name --}}
                    <h3 class="mb-1">

                        {{ $technology->name }}

                    </h3>


                    {{-- Slug --}}
                    <div class="mb-3">

                        <code>
                            {{ $technology->slug }}
                        </code>

                    </div>


                    {{-- Status --}}
                    @if($technology->status)

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


            {{-- ========================================= --}}
            {{-- SETTINGS --}}
            {{-- ========================================= --}}

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Settings
                    </h5>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Display Order
                        </span>

                        <strong>
                            {{ $technology->order }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Created
                        </span>

                        <strong>
                            {{ $technology->created_at?->format('d M Y') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- RIGHT COLUMN --}}
        {{-- ========================================= --}}

        <div class="col-lg-8">


            {{-- ========================================= --}}
            {{-- DESCRIPTION --}}
            {{-- ========================================= --}}

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Description
                    </h5>

                </div>


                <div class="card-body">

                    @if($technology->description)

                        <p class="mb-0">
                            {{ $technology->description }}
                        </p>

                    @else

                        <p class="text-muted mb-0">
                            No description available.
                        </p>

                    @endif

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- RELATED PROJECTS --}}
            {{-- ========================================= --}}

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Projects Using This Technology
                    </h5>


                    <span class="badge bg-primary">

                        {{ $technology->projects->count() }}

                    </span>

                </div>


                <div class="card-body p-0">

                    @if($technology->projects->count())

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th>
                                            Project
                                        </th>

                                        <th>
                                            Client
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th class="text-end">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($technology->projects as $project)

                                        <tr>

                                            <td>

                                                <div class="fw-semibold">

                                                    {{ $project->title }}

                                                </div>

                                                <small class="text-muted">

                                                    {{ $project->slug }}

                                                </small>

                                            </td>


                                            <td>

                                                {{ $project->client_name ?? '—' }}

                                            </td>


                                            <td>

                                                @if($project->status)

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>

                                                @endif

                                            </td>


                                            <td class="text-end">

                                                <a
                                                    href="{{ route('projects.show', $project) }}"
                                                    class="btn btn-sm btn-outline-info"
                                                >

                                                    <i class="bi bi-eye"></i>

                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i
                                class="bi bi-folder2-open text-muted"
                                style="font-size:3rem;"
                            ></i>

                            <h5 class="mt-3">
                                No Projects Found
                            </h5>

                            <p class="text-muted">
                                This technology has not been assigned to any project yet.
                            </p>

                            <a
                                href="{{ route('projects.create') }}"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-plus-lg"></i>

                                Create Project

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

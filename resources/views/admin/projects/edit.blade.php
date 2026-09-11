@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Edit Project</h2>

            <p class="text-muted mb-0">
                Update project information and settings.
            </p>
        </div>

        <a href="{{ route('projects.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Edit Form --}}
    <form action="{{ route('projects.update', $project) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @method('PUT')

        @include('admin.projects._form')

    </form>

</div>

@endsection

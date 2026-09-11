@extends('admin.layouts.app')

@section('title', 'Add Project')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Add New Project</h2>

            <p class="text-muted mb-0">
                Create a new project for your company portfolio.
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


    {{-- Project Form --}}
    <form action="{{ route('projects.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('admin.projects._form')

    </form>

</div>

@endsection

@extends('admin.layouts.app')

@section('title', 'Add Technology')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Add New Technology</h2>

            <p class="text-muted mb-0">
                Add a technology that can be assigned to company projects.
            </p>
        </div>

        <a href="{{ route('technologies.index') }}"
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


    {{-- Technology Form --}}
    <form
        action="{{ route('technologies.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @include('admin.technologies._form')

    </form>

</div>

@endsection

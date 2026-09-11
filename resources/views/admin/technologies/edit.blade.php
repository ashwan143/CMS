@extends('admin.layouts.app')

@section('title', 'Edit Technology')

@section('content')

<div class="container-fluid">

    {{-- ========================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Edit Technology
            </h2>

            <p class="text-muted mb-0">
                Update technology information and settings.
            </p>

        </div>


        <a
            href="{{ route('technologies.index') }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>


    {{-- ========================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================= --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================= --}}
    {{-- UPDATE FORM --}}
    {{-- ========================================= --}}

    <form
        action="{{ route('technologies.update', $technology) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        {{-- Reuse Technology Form --}}
        @include('admin.technologies._form')

    </form>

</div>

@endsection

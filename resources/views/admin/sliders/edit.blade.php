@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Slider
            </h4>

            <p class="text-muted mb-0">
                Update slider content, images and display settings.
            </p>

        </div>

        <div>

            <a
                href="{{ route('sliders.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back to Sliders
            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle me-1"></i>

                Please correct the following errors:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        EDIT FORM
    ========================================================== --}}
    <form
        action="{{ route('sliders.update', $slider) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')

        @include('admin.sliders._form')

    </form>

</div>

@endsection

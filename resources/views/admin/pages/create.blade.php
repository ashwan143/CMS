
@extends('admin.layouts.app')

@section('title', 'Create Page')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Create Page</h2>

            <p class="text-muted mb-0">
                Create a new website page.
            </p>
        </div>

        <a href="{{ route('pages.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Pages

        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('pages.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            Page Information
                        </h5>

                    </div>

                    <div class="card-body">

                        @include('admin.pages._form')

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            <i class="bi bi-check-circle me-2"></i>
                            Publish
                        </h5>

                    </div>

                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-check-lg me-1"></i>
                            Create Page

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@extends('admin.layouts.app')

@section('title', 'Add Service')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Add New Service</h2>

        <p class="text-muted mb-0">
            Create a new service for your company website.
        </p>
    </div>


    <a href="{{ route('services.index') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left"></i>
        Back

    </a>

</div>


<form action="{{ route('services.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @include('admin.services._form')

</form>


@endsection

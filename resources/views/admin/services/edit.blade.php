@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Edit Service</h2>

        <p class="text-muted mb-0">
            Update company service information.
        </p>
    </div>


    <a href="{{ route('services.index') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left"></i>
        Back

    </a>

</div>


<form action="{{ route('services.update',$service->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @method('PUT')


    @include('admin.services._form')


</form>


@endsection

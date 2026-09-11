@extends('admin.layouts.app')

@section('title','Edit User')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Edit User</h2>

            <small class="text-muted">
                Update user information
            </small>

        </div>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('users.update',$user->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                @include('admin.users.form')

            </form>

        </div>

    </div>

</div>

@endsection

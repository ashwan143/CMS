@extends('admin.layouts.app')

@section('title', 'Service Management')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-0">Service Management</h2>
            <small class="text-muted">
                Manage all company services
            </small>
        </div>

        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add Service
        </a>

    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <!-- Search -->
            <div class="row mb-3">

                <div class="col-md-6">

                    <form method="GET" action="{{ route('services.index') }}">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Search service..."
                                value="{{ request('search') }}">

                            <button class="btn btn-primary">
                                <i class="bi bi-search"></i>
                                Search
                            </button>

                            <a href="{{ route('services.index') }}"
                               class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Table -->

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($services as $service)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>

                                @if($service->image)

                                    <img src="{{ asset('storage/'.$service->image) }}"
                                         width="60"
                                         class="rounded">

                                @else

                                    <span class="badge bg-secondary">
                                        No Image
                                    </span>

                                @endif

                            </td>

                            <td>

                                <strong>{{ $service->title }}</strong>

                            </td>

                            <td>

                                {{ $service->slug }}

                            </td>

                            <td>

                                @if($service->status)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $service->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <a href="{{ route('services.show',$service->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="{{ route('services.edit',$service->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ route('services.destroy',$service->id) }}"
                                      method="POST"
                                      class="d-inline delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                No services found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $services->links() }}

            </div>

        </div>

    </div>

</div>
<script>

document.querySelectorAll('.delete-form')
.forEach(function(form){


    form.addEventListener('submit', function(e){


        e.preventDefault();


        Swal.fire({

            title: 'Are you sure?',

            text: "This service will be deleted permanently!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Yes, Delete',

            cancelButtonText: 'Cancel'


        }).then((result)=>{


            if(result.isConfirmed){

                form.submit();

            }


        });


    });


});

</script>

@endsection

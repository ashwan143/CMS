@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Inquiry Details</h1>
            <p class="text-muted mb-0">View customer inquiry information.</p>
        </div>

        <a href="{{ route('inquiries.index') }}" class="btn btn-secondary">
            Back to Inquiries
        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    @php
        $statusLabels = [
            0 => ['label' => 'New', 'class' => 'bg-primary'],
            1 => ['label' => 'In Progress', 'class' => 'bg-warning text-dark'],
            2 => ['label' => 'Resolved', 'class' => 'bg-success'],
            3 => ['label' => 'Closed', 'class' => 'bg-secondary'],
        ];

        $currentStatus = $statusLabels[$inquiry->status] ?? [
            'label' => 'Unknown',
            'class' => 'bg-dark'
        ];
    @endphp

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                {{-- Customer Information --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">Customer Information</h5>

                    <p>
                        <strong>Name:</strong><br>
                        {{ $inquiry->name }}
                    </p>

                    <p>
                        <strong>Email:</strong><br>

                        @if($inquiry->email)
                            <a href="mailto:{{ $inquiry->email }}">
                                {{ $inquiry->email }}
                            </a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>

                    <p>
                        <strong>Phone:</strong><br>

                        @if($inquiry->phone)
                            <a href="tel:{{ $inquiry->phone }}">
                                {{ $inquiry->phone }}
                            </a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>

                    <p>
                        <strong>Type:</strong><br>
                        {{ $inquiry->type ?? '-' }}
                    </p>

                </div>

                {{-- Inquiry Information --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">Inquiry Information</h5>

                    <p>
                        <strong>Subject:</strong><br>
                        {{ $inquiry->subject ?? '-' }}
                    </p>

                    <p>
                        <strong>Status:</strong><br>

                        <span class="badge {{ $currentStatus['class'] }}">
                            {{ $currentStatus['label'] }}
                        </span>
                    </p>

                    <p>
                        <strong>Assigned To:</strong><br>
                        {{ $inquiry->assignedUser?->name ?? 'Unassigned' }}
                    </p>

                    <p>
                        <strong>Received:</strong><br>
                        {{ $inquiry->created_at?->format('d M Y, h:i A') ?? '-' }}
                    </p>

                </div>

            </div>

            <hr>

            {{-- Message --}}
            <div class="mb-4">

                <h5 class="mb-3">Message</h5>

                <div class="border rounded p-3 bg-light">
                    {!! nl2br(e($inquiry->message)) !!}
                </div>

            </div>

            <hr>

            {{-- Update Status --}}
            <div class="mb-4">

                <h5 class="mb-3">Update Status</h5>

                <form
                    action="{{ route('inquiries.update-status', $inquiry) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <div class="row align-items-end">

                        <div class="col-md-6">

                            <label for="status" class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                            >

                                <option value="0" {{ $inquiry->status == 0 ? 'selected' : '' }}>
                                    New
                                </option>

                                <option value="1" {{ $inquiry->status == 1 ? 'selected' : '' }}>
                                    In Progress
                                </option>

                                <option value="2" {{ $inquiry->status == 2 ? 'selected' : '' }}>
                                    Resolved
                                </option>

                                <option value="3" {{ $inquiry->status == 3 ? 'selected' : '' }}>
                                    Closed
                                </option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-3 mt-3 mt-md-0">

                            <button type="submit" class="btn btn-primary">
                                Update Status
                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <hr>

            {{-- Assign Inquiry --}}
            <div class="mb-4">

                <h5 class="mb-3">Assign Inquiry</h5>

                <form
                    action="{{ route('inquiries.assign', $inquiry) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <div class="row align-items-end">

                        <div class="col-md-6">

                            <label for="assigned_to" class="form-label">
                                Assign To
                            </label>

                            <select
                                name="assigned_to"
                                id="assigned_to"
                                class="form-select @error('assigned_to') is-invalid @enderror"
                            >

                                <option value="">
                                    Unassigned
                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ $inquiry->assigned_to == $user->id ? 'selected' : '' }}
                                    >
                                        {{ $user->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('assigned_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-3 mt-3 mt-md-0">

                            <button type="submit" class="btn btn-primary">
                                Assign Inquiry
                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <hr>

            {{-- Actions --}}
            <div class="d-flex gap-2">

                @if($inquiry->email)
                    <a
                        href="mailto:{{ $inquiry->email }}"
                        class="btn btn-primary"
                    >
                        Reply by Email
                    </a>
                @endif

                @if($inquiry->phone)
                    <a
                        href="tel:{{ $inquiry->phone }}"
                        class="btn btn-success"
                    >
                        Call
                    </a>
                @endif

                <form
                    action="{{ route('inquiries.destroy', $inquiry) }}"
                    method="POST"
                    class="delete-form"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection

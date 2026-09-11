@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Newsletter Subscriber</h1>
            <p class="text-muted mb-0">View subscriber information.</p>
        </div>

        <a
            href="{{ route('newsletter-subscribers.index') }}"
            class="btn btn-secondary"
        >
            Back to Subscribers
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

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <h5>Name</h5>

                    <p>
                        {{ $newsletterSubscriber->name ?? '-' }}
                    </p>

                </div>

                <div class="col-md-6 mb-3">

                    <h5>Email</h5>

                    <p>
                        <a href="mailto:{{ $newsletterSubscriber->email }}">
                            {{ $newsletterSubscriber->email }}
                        </a>
                    </p>

                </div>

                <div class="col-md-6 mb-3">

                    <h5>Status</h5>

                    <p>
                        @if($newsletterSubscriber->status)
                            <span class="badge bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Inactive
                            </span>
                        @endif
                    </p>

                </div>

                <div class="col-md-6 mb-3">

                    <h5>Subscribed At</h5>

                    <p>
                        {{ $newsletterSubscriber->subscribed_at?->format('d M Y, h:i A') ?? '-' }}
                    </p>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <form
                    action="{{ route('newsletter-subscribers.update-status', $newsletterSubscriber) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="{{ $newsletterSubscriber->status ? 0 : 1 }}"
                    >

                    <button
                        type="submit"
                        class="btn {{ $newsletterSubscriber->status ? 'btn-warning' : 'btn-success' }}"
                    >
                        {{ $newsletterSubscriber->status ? 'Disable Subscriber' : 'Enable Subscriber' }}
                    </button>

                </form>

                <a
                    href="mailto:{{ $newsletterSubscriber->email }}"
                    class="btn btn-primary"
                >
                    Email Subscriber
                </a>

                <form
                    action="{{ route('newsletter-subscribers.destroy', $newsletterSubscriber) }}"
                    method="POST"
                    class="delete-form"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

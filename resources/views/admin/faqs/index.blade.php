@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">FAQs</h1>
            <p class="text-muted mb-0">Manage frequently asked questions.</p>
        </div>

        <a href="{{ route('faqs.create') }}" class="btn btn-primary">
            Add FAQ
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Search --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('faqs.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search question, answer or category..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">
                            Search
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- FAQ Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>Question</th>
                            <th>Category</th>
                            <th width="100">Order</th>
                            <th width="100">Status</th>
                            <th width="110">Featured</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($faqs as $faq)

                            <tr>

                                <td>
                                    {{ $faqs->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $faq->question }}</strong>

                                    @if($faq->short_question)
                                        <br>
                                        <small class="text-muted">
                                            {{ $faq->short_question }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    {{ $faq->category ?? '-' }}
                                </td>

                                <td>
                                    {{ $faq->order }}
                                </td>

                                <td>
                                    @if($faq->status)
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
                                    @if($faq->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            Featured
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('faqs.show', $faq) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="View"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('faqs.edit', $faq) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('faqs.destroy', $faq) }}"
                                            method="POST"
                                            class="d-inline delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Delete"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <span class="text-muted">
                                        No FAQs found.
                                    </span>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($faqs->hasPages())
                <div class="mt-3">
                    {{ $faqs->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

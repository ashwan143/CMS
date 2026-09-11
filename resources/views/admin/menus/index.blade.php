@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-list-nested me-2"></i>
                Menus
            </h4>

            <p class="text-muted mb-0">
                Manage website navigation menus and menu items.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Add Menu
            </a>
        </div>

    </div>


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('menus.index') }}">

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-md-5">

                        <label for="search" class="form-label">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                id="search"
                                class="form-control"
                                placeholder="Search menu title or URL..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    {{-- Location --}}
                    <div class="col-md-3">

                        <label for="location" class="form-label">
                            Location
                        </label>

                        <select
                            name="location"
                            id="location"
                            class="form-select"
                        >

                            <option value="">
                                All Locations
                            </option>

                            <option value="header"
                                {{ request('location') === 'header' ? 'selected' : '' }}>
                                Header
                            </option>

                            <option value="footer"
                                {{ request('location') === 'footer' ? 'selected' : '' }}>
                                Footer
                            </option>

                            <option value="mobile"
                                {{ request('location') === 'mobile' ? 'selected' : '' }}>
                                Mobile
                            </option>

                            <option value="sidebar"
                                {{ request('location') === 'sidebar' ? 'selected' : '' }}>
                                Sidebar
                            </option>

                        </select>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-2">

                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-2">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                <i class="bi bi-funnel me-1"></i>
                                Filter
                            </button>

                            <a
                                href="{{ route('menus.index') }}"
                                class="btn btn-outline-secondary"
                                title="Reset"
                            >
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        MENU TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">
                                #
                            </th>

                            <th>
                                Menu
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Location
                            </th>

                            <th>
                                Order
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="180" class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($menus as $menu)

                            <tr>

                                {{-- Number --}}
                                <td>
                                    {{ $menus->firstItem() + $loop->index }}
                                </td>


                                {{-- Menu --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        @if($menu->parent_id)
                                            <span class="text-muted me-2">
                                                <i class="bi bi-arrow-return-right"></i>
                                            </span>
                                        @else
                                            <span class="me-2">
                                                <i class="bi bi-list-nested text-primary"></i>
                                            </span>
                                        @endif


                                        <div>

                                            <div class="fw-semibold">

                                                @if($menu->icon)
                                                    <i class="{{ $menu->icon }} me-1"></i>
                                                @endif

                                                {{ $menu->title }}

                                            </div>


                                            @if($menu->parent)

                                                <small class="text-muted">
                                                    Child of:
                                                    {{ $menu->parent->title }}
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Type --}}
                                <td>

                                    @if($menu->type === 'page')

                                        <span class="badge bg-primary">
                                            Page
                                        </span>

                                    @elseif($menu->type === 'custom_url')

                                        <span class="badge bg-info text-dark">
                                            Custom URL
                                        </span>

                                    @elseif($menu->type === 'external_url')

                                        <span class="badge bg-secondary">
                                            External URL
                                        </span>

                                    @endif

                                </td>


                                {{-- Location --}}
                                <td>

                                    @switch($menu->location)

                                        @case('header')

                                            <span class="badge bg-dark">
                                                Header
                                            </span>

                                            @break

                                        @case('footer')

                                            <span class="badge bg-secondary">
                                                Footer
                                            </span>

                                            @break

                                        @case('mobile')

                                            <span class="badge bg-info text-dark">
                                                Mobile
                                            </span>

                                            @break

                                        @case('sidebar')

                                            <span class="badge bg-warning text-dark">
                                                Sidebar
                                            </span>

                                            @break

                                    @endswitch

                                </td>


                                {{-- Order --}}
                                <td>
                                    {{ $menu->display_order }}
                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($menu->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-end">

                                    <div class="btn-group">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('menus.show', $menu) }}"
                                            class="btn btn-sm btn-outline-info"
                                            title="View"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('menus.edit', $menu) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('menus.destroy', $menu) }}"
                                            method="POST"
                                            class="delete-menu-form d-inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-menu-button-wide display-5 d-block mb-3"></i>

                                        <h6 class="mb-1">
                                            No menus found
                                        </h6>

                                        <p class="mb-3">
                                            Start by creating your first menu item.
                                        </p>

                                        <a
                                            href="{{ route('menus.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Add Menu
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($menus->hasPages())

            <div class="card-footer bg-white">

                {{ $menus->links() }}

            </div>

        @endif

    </div>

</div>


{{-- =============================================================
    DELETE CONFIRMATION
============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-menu-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            if (typeof Swal !== 'undefined') {

                Swal.fire({
                    title: 'Delete Menu?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }

                });

            } else {

                if (confirm('Are you sure you want to delete this menu?')) {
                    form.submit();
                }

            }

        });

    });

});
</script>

@endsection

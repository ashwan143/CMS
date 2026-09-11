@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-eye me-2"></i>
                Menu Details
            </h4>

            <p class="text-muted mb-0">
                View complete information about this menu item.
            </p>
        </div>

        <div class="mt-3 mt-md-0 d-flex gap-2">

            <a
                href="{{ route('menus.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

            <a
                href="{{ route('menus.edit', $menu) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil-square me-1"></i>
                Edit
            </a>

        </div>

    </div>


    {{-- =========================================================
        BASIC INFORMATION
    ========================================================== --}}
    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-list-nested me-2"></i>
                        Menu Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle mb-0">

                            <tbody>

                                {{-- Title --}}
                                <tr>
                                    <th width="30%" class="bg-light">
                                        Title
                                    </th>

                                    <td>
                                        <strong>
                                            {{ $menu->title }}
                                        </strong>
                                    </td>
                                </tr>


                                {{-- Type --}}
                                <tr>
                                    <th class="bg-light">
                                        Type
                                    </th>

                                    <td>

                                        @if($menu->type === 'page')

                                            <span class="badge bg-primary">
                                                Page
                                            </span>

                                        @elseif($menu->type === 'custom_url')

                                            <span class="badge bg-info text-dark">
                                                Custom URL
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                External URL
                                            </span>

                                        @endif

                                    </td>
                                </tr>


                                {{-- Page --}}
                                @if($menu->type === 'page')

                                    <tr>

                                        <th class="bg-light">
                                            Page
                                        </th>

                                        <td>

                                            @if($menu->page)

                                                {{ $menu->page->title }}

                                            @else

                                                <span class="text-muted">
                                                    Page not found
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endif


                                {{-- URL --}}
                                @if($menu->url)

                                    <tr>

                                        <th class="bg-light">
                                            URL
                                        </th>

                                        <td>

                                            <code>
                                                {{ $menu->url }}
                                            </code>

                                        </td>

                                    </tr>

                                @endif


                                {{-- Parent --}}
                                <tr>

                                    <th class="bg-light">
                                        Parent Menu
                                    </th>

                                    <td>

                                        @if($menu->parent)

                                            <a
                                                href="{{ route('menus.show', $menu->parent) }}"
                                                class="text-decoration-none"
                                            >
                                                <i class="bi bi-arrow-up-right me-1"></i>
                                                {{ $menu->parent->title }}
                                            </a>

                                        @else

                                            <span class="text-muted">
                                                Top Level Menu
                                            </span>

                                        @endif

                                    </td>

                                </tr>


                                {{-- Location --}}
                                <tr>

                                    <th class="bg-light">
                                        Location
                                    </th>

                                    <td>

                                        @php
                                            $locationLabels = [
                                                'header' => 'Header',
                                                'footer' => 'Footer',
                                                'mobile' => 'Mobile',
                                                'sidebar' => 'Sidebar',
                                            ];
                                        @endphp

                                        <span class="badge bg-dark">
                                            {{ $locationLabels[$menu->location] ?? ucfirst($menu->location) }}
                                        </span>

                                    </td>

                                </tr>


                                {{-- Target --}}
                                <tr>

                                    <th class="bg-light">
                                        Target
                                    </th>

                                    <td>

                                        @if($menu->target === '_blank')

                                            <span class="badge bg-warning text-dark">
                                                New Tab
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Same Tab
                                            </span>

                                        @endif

                                    </td>

                                </tr>


                                {{-- Icon --}}
                                <tr>

                                    <th class="bg-light">
                                        Icon
                                    </th>

                                    <td>

                                        @if($menu->icon)

                                            <i class="{{ $menu->icon }} me-2"></i>

                                            <code>
                                                {{ $menu->icon }}
                                            </code>

                                        @else

                                            <span class="text-muted">
                                                No icon
                                            </span>

                                        @endif

                                    </td>

                                </tr>


                                {{-- Display Order --}}
                                <tr>

                                    <th class="bg-light">
                                        Display Order
                                    </th>

                                    <td>
                                        {{ $menu->display_order }}
                                    </td>

                                </tr>


                                {{-- Status --}}
                                <tr>

                                    <th class="bg-light">
                                        Status
                                    </th>

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

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            CHILDREN
        ====================================================== --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-diagram-3 me-2"></i>
                        Child Menus
                    </h5>

                </div>

                <div class="card-body p-0">

                    @if($menu->children->count())

                        <div class="list-group list-group-flush">

                            @foreach($menu->children as $child)

                                <a
                                    href="{{ route('menus.show', $child) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                >

                                    <span>

                                        @if($child->icon)
                                            <i class="{{ $child->icon }} me-2"></i>
                                        @endif

                                        {{ $child->title }}

                                    </span>

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @endforeach

                        </div>

                    @else

                        <div class="p-4 text-center text-muted">

                            <i class="bi bi-diagram-3 fs-3 d-block mb-2"></i>

                            No child menus.

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                TIMESTAMPS
            ================================================== --}}
            <div class="card border-0 shadow-sm mt-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Record Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Created
                        </small>

                        <strong>
                            {{ $menu->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                        </strong>

                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Last Updated
                        </small>

                        <strong>
                            {{ $menu->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

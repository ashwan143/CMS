<div class="bg-dark text-white p-3 sidebar"
     style="width:260px; min-height:100vh;">

    {{-- Admin Profile --}}
    <div class="text-center">

        <img
            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
            class="rounded-circle mb-2"
            width="70"
            height="70"
            alt="{{ auth()->user()->name }}"
        >

        <h6 class="mb-1">
            {{ auth()->user()->name }}
        </h6>

        <small class="text-success">
            Administrator
        </small>

    </div>

    <hr>

    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a
                href="{{ route('dashboard') }}"
                class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>


        {{-- MANAGEMENT --}}
        <li class="section-title mt-3">
            MANAGEMENT
        </li>

        @permission('users.view')
        <li class="nav-item">
            <a
                href="{{ route('users.index') }}"
                class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
            >
                <i class="bi bi-people me-2"></i>
                Users
            </a>
        </li>
        @endpermission

        @permission('roles.view')
        <li class="nav-item">
            <a
                href="{{ route('roles.index') }}"
                class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
            >
                <i class="bi bi-shield-check me-2"></i>
                Roles & Permissions
            </a>
        </li>
        @endpermission


        {{-- WEBSITE --}}
        <li class="section-title mt-3">
            WEBSITE
        </li>

        @permission('pages.view')
        <li class="nav-item">
            <a
                href="{{ route('pages.index') }}"
                class="sidebar-link {{ request()->routeIs('pages.*') ? 'active' : '' }}"
            >
                <i class="bi bi-file-earmark-text me-2"></i>
                Pages
            </a>
        </li>
        @endpermission

        @permission('menus.view')
        <li class="nav-item">
            <a
                href="{{ route('menus.index') }}"
                class="sidebar-link {{ request()->routeIs('menus.*') ? 'active' : '' }}"
            >
                <i class="bi bi-list me-2"></i>
                Menus
            </a>
        </li>
        @endpermission

        @permission('sliders.view')
        <li class="nav-item">
            <a
                href="{{ route('sliders.index') }}"
                class="sidebar-link {{ request()->routeIs('sliders.*') ? 'active' : '' }}"
            >
                <i class="bi bi-images me-2"></i>
                Sliders
            </a>
        </li>
        @endpermission


        {{-- BUSINESS --}}
        <li class="section-title mt-3">
            BUSINESS
        </li>

        @permission('services.view')
        <li class="nav-item">
            <a
                href="{{ route('services.index') }}"
                class="sidebar-link {{ request()->routeIs('services.*') ? 'active' : '' }}"
            >
                <i class="bi bi-gear me-2"></i>
                Services
            </a>
        </li>
        @endpermission

        @permission('projects.view')
        <li class="nav-item">
            <a
                href="{{ route('projects.index') }}"
                class="sidebar-link {{ request()->routeIs('projects.*') ? 'active' : '' }}"
            >
                <i class="bi bi-kanban me-2"></i>
                Projects
            </a>
        </li>
        @endpermission

        @permission('technologies.view')
        <li class="nav-item">
            <a
                href="{{ route('technologies.index') }}"
                class="sidebar-link {{ request()->routeIs('technologies.*') ? 'active' : '' }}"
            >
                <i class="bi bi-cpu me-2"></i>
                Technologies
            </a>
        </li>
        @endpermission

        <li class="nav-item">
            <a
                href="{{ route('clients.index') }}"
                class="sidebar-link {{ request()->routeIs('clients.*') ? 'active' : '' }}"
            >
                <i class="bi bi-building me-2"></i>
                Clients
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('team-members.index') }}"
                class="sidebar-link {{ request()->routeIs('team-members.*') ? 'active' : '' }}"
            >
                <i class="bi bi-person-badge me-2"></i>
                Team Members
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('job-openings.index') }}"
                class="sidebar-link {{ request()->routeIs('job-openings.*') ? 'active' : '' }}"
            >
                <i class="bi bi-briefcase me-2"></i>
                Job Openings
            </a>
        </li>


        {{-- CONTENT --}}
        <li class="section-title mt-3">
            CONTENT
        </li>

        @permission('blogs.view')
        <li class="nav-item">
            <a
                href="{{ route('blogs.index') }}"
                class="sidebar-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}"
            >
                <i class="bi bi-journal-text me-2"></i>
                Blogs
            </a>
        </li>
        @endpermission

        @permission('testimonials.view')
        <li class="nav-item">
            <a
                href="{{ route('testimonials.index') }}"
                class="sidebar-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}"
            >
                <i class="bi bi-chat-quote me-2"></i>
                Testimonials
            </a>
        </li>
        @endpermission

        <li class="nav-item">
            <a
                href="{{ route('faqs.index') }}"
                class="sidebar-link {{ request()->routeIs('faqs.*') ? 'active' : '' }}"
            >
                <i class="bi bi-question-circle me-2"></i>
                FAQs
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('gallery-images.index') }}"
                class="sidebar-link {{ request()->routeIs('gallery-images.*') ? 'active' : '' }}"
            >
                <i class="bi bi-images me-2"></i>
                Gallery
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('albums.index') }}"
                class="sidebar-link {{ request()->routeIs('albums.*') ? 'active' : '' }}"
            >
                <i class="bi bi-collection me-2"></i>
                Albums
            </a>
        </li>


        {{-- LEADS & COMMUNICATION --}}
        <li class="section-title mt-3">
            LEADS & COMMUNICATION
        </li>

        <li class="nav-item">
            <a
                href="{{ route('inquiries.index') }}"
                class="sidebar-link {{ request()->routeIs('inquiries.*') ? 'active' : '' }}"
            >
                <i class="bi bi-chat-left-text me-2"></i>
                Inquiries
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('contact-messages.index') }}"
                class="sidebar-link {{ request()->routeIs('contact-messages.*') ? 'active' : '' }}"
            >
                <i class="bi bi-envelope me-2"></i>
                Contact Messages
            </a>
        </li>

        <li class="nav-item">
            <a
                href="{{ route('newsletter-subscribers.index') }}"
                class="sidebar-link {{ request()->routeIs('newsletter-subscribers.*') ? 'active' : '' }}"
            >
                <i class="bi bi-newspaper me-2"></i>
                Newsletter
            </a>
        </li>


        {{-- SYSTEM --}}
        <li class="section-title mt-3">
            SYSTEM
        </li>

        @permission('settings.view')
        <li class="nav-item">
            <a
                href="{{ route('settings.index') }}"
                class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}"
            >
                <i class="bi bi-gear me-2"></i>
                Settings
            </a>
        </li>
        @endpermission

        <li class="nav-item">
            <a
                href="{{ route('activity-logs.index') }}"
                class="sidebar-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}"
            >
                <i class="bi bi-clock-history me-2"></i>
                Activity Logs
            </a>
        </li>


        <hr class="my-3">


        {{-- Logout --}}
        <li class="nav-item">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-danger w-100"
                >
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>

            </form>

        </li>

    </ul>

</div>

<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-3 px-lg-4 py-2">

    {{-- Mobile Sidebar Button --}}
    <button
        class="btn btn-dark d-lg-none me-3"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileSidebar"
        aria-controls="mobileSidebar"
        aria-label="Open sidebar"
    >
        <i class="bi bi-list fs-5"></i>
    </button>


    {{-- Search --}}
    <form
        class="d-none d-md-flex flex-grow-1 me-4"
        method="GET"
        action="{{ route('dashboard') }}"
    >

        <div class="input-group">

            <span class="input-group-text bg-light border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>

            <input
                type="search"
                name="search"
                class="form-control bg-light border-start-0"
                placeholder="Search..."
                value="{{ request('search') }}"
            >

        </div>

    </form>


    {{-- Right Menu --}}
    <ul class="navbar-nav ms-auto align-items-center">

        {{-- Mobile Search --}}
        <li class="nav-item d-md-none me-2">

            <button
                class="btn btn-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mobileSearch"
                aria-label="Search"
            >
                <i class="bi bi-search"></i>
            </button>

        </li>


        {{-- Notifications --}}
        <li class="nav-item dropdown me-2">

            <a
                class="nav-link position-relative p-2"
                href="#"
                id="notificationDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                aria-label="Notifications"
            >

                <i class="bi bi-bell fs-5"></i>

                {{-- Notification Count --}}
                <span
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 10px;"
                >
                    3
                </span>

            </a>


            <ul
                class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                aria-labelledby="notificationDropdown"
                style="min-width: 280px;"
            >

                <li class="px-3 py-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <strong>
                            Notifications
                        </strong>

                        <small class="text-muted">
                            Recent
                        </small>

                    </div>

                </li>

                <li>
                    <hr class="dropdown-divider my-0">
                </li>


                <li>
                    <a class="dropdown-item py-3" href="{{ route('contact-messages.index') }}">

                        <div class="d-flex">

                            <div class="me-3 text-danger">
                                <i class="bi bi-envelope-fill"></i>
                            </div>

                            <div>
                                <div class="fw-semibold">
                                    Contact Messages
                                </div>

                                <small class="text-muted">
                                    Check recent visitor messages
                                </small>
                            </div>

                        </div>

                    </a>
                </li>


                <li>
                    <a class="dropdown-item py-3" href="{{ route('newsletter-subscribers.index') }}">

                        <div class="d-flex">

                            <div class="me-3 text-primary">
                                <i class="bi bi-newspaper"></i>
                            </div>

                            <div>
                                <div class="fw-semibold">
                                    Newsletter
                                </div>

                                <small class="text-muted">
                                    Manage subscribers
                                </small>
                            </div>

                        </div>

                    </a>
                </li>


                <li>
                    <a class="dropdown-item py-3" href="{{ route('inquiries.index') }}">

                        <div class="d-flex">

                            <div class="me-3 text-warning">
                                <i class="bi bi-chat-left-text-fill"></i>
                            </div>

                            <div>
                                <div class="fw-semibold">
                                    Inquiries
                                </div>

                                <small class="text-muted">
                                    Review customer inquiries
                                </small>
                            </div>

                        </div>

                    </a>
                </li>


                <li>
                    <hr class="dropdown-divider">
                </li>


                <li>
                    <a
                        class="dropdown-item text-center text-primary py-2"
                        href="{{ route('activity-logs.index') }}"
                    >
                        View Activity Logs
                    </a>
                </li>

            </ul>

        </li>


        {{-- Admin Profile --}}
        <li class="nav-item dropdown">

            <a
                class="nav-link dropdown-toggle d-flex align-items-center px-2"
                href="#"
                id="adminProfileDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0d6efd&color=fff"
                    class="rounded-circle me-2"
                    width="38"
                    height="38"
                    alt="{{ auth()->user()->name }}"
                >

                <div class="d-none d-sm-block text-start">

                    <div class="fw-semibold text-dark">
                        {{ auth()->user()->name }}
                    </div>

                    <small class="text-muted">
                        Administrator
                    </small>

                </div>

            </a>


            <ul
                class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                aria-labelledby="adminProfileDropdown"
            >

                {{-- Profile --}}
                <li>

                    <a
                        class="dropdown-item py-2"
                        href="{{ route('profile.edit') }}"
                    >

                        <i class="bi bi-person me-2"></i>

                        Profile

                    </a>

                </li>


                {{-- Settings --}}
                <li>

                    <a
                        class="dropdown-item py-2"
                        href="{{ route('settings.index') }}"
                    >

                        <i class="bi bi-gear me-2"></i>

                        Settings

                    </a>

                </li>


                {{-- Activity Logs --}}
                <li>

                    <a
                        class="dropdown-item py-2"
                        href="{{ route('activity-logs.index') }}"
                    >

                        <i class="bi bi-clock-history me-2"></i>

                        Activity Logs

                    </a>

                </li>


                <li>
                    <hr class="dropdown-divider">
                </li>


                {{-- Logout --}}
                <li>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="dropdown-item text-danger py-2"
                        >

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </li>

    </ul>

</nav>


{{-- Mobile Search --}}
<div class="collapse bg-white border-bottom px-3 py-2 d-md-none" id="mobileSearch">

    <form
        method="GET"
        action="{{ route('dashboard') }}"
    >

        <div class="input-group">

            <span class="input-group-text bg-light border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>

            <input
                type="search"
                name="search"
                class="form-control bg-light border-start-0"
                placeholder="Search..."
                value="{{ request('search') }}"
            >

        </div>

    </form>

</div>

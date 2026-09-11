<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid">

        <!-- Sidebar Toggle -->
        <button class="btn btn-outline-secondary me-3" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            CMS Admin
        </a>

        <!-- Search -->
        <form class="d-none d-md-flex ms-4" role="search">
            <input class="form-control" type="search" placeholder="Search...">
        </form>

        <div class="ms-auto d-flex align-items-center">

            <!-- Notification -->
            <button class="btn btn-light me-2">
                <i class="bi bi-bell"></i>
            </button>

            <!-- Fullscreen -->
            <button class="btn btn-light me-3" id="fullscreenBtn">
                <i class="bi bi-arrows-fullscreen"></i>
            </button>

            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle"
                        data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i>
                            Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear"></i>
                            Settings
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>

    </div>
</nav>

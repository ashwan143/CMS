<footer class="bg-white border-top mt-auto">

    <div class="container-fluid px-4 py-3">

        <div class="row align-items-center">

            {{-- Copyright --}}
            <div class="col-md-6 text-center text-md-start">

                <small class="text-muted">
                    &copy; {{ date('Y') }}
                    <strong>CMS Admin</strong>.
                    All rights reserved.
                </small>

            </div>


            {{-- Footer Links --}}
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">

                <a
                    href="{{ route('dashboard') }}"
                    class="text-decoration-none text-muted me-3"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('settings.index') }}"
                    class="text-decoration-none text-muted me-3"
                >
                    Settings
                </a>

                <a
                    href="{{ route('activity-logs.index') }}"
                    class="text-decoration-none text-muted"
                >
                    Activity Logs
                </a>

            </div>

        </div>

    </div>

</footer>

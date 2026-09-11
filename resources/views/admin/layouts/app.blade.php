<!DOCTYPE html>
<html>

<head>

<title>
@yield('title') - CMS Admin
</title>


<meta name="viewport" content="width=device-width, initial-scale=1">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<style>

.sidebar-link:hover,
.sidebar-link.active
{
    background:#0d6efd;
    border-radius:8px;
}


.sidebar-link
{
    display:block;
    padding:10px;
    color:white;
    text-decoration:none;
}


.section-title
{
    font-size:12px;
    color:#9ca3af;
    margin-top:20px;
}

.sidebar
{
    position:sticky;
    top:0;
}


.navbar
{
    height:70px;
}

</style>


</head>


<body>


<div class="d-flex">


@include('admin.layouts.sidebar')

<div class="offcanvas offcanvas-start bg-dark text-white"
id="mobileSidebar">

<div class="offcanvas-header">

<h5>
CMS Admin
</h5>


<button type="button"
class="btn-close btn-close-white"
data-bs-dismiss="offcanvas">

</button>


</div>


<div class="offcanvas-body p-0">

@include('admin.layouts.sidebar')

</div>


</div>


<div class="flex-grow-1">


@include('admin.layouts.header')


<main class="p-4">
@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

@endif
@yield('content')

</main>


@include('admin.layouts.footer')


</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: @json(session('success')),
            confirmButtonText: 'OK',
            timer: 2500,
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: @json(session('error')),
            confirmButtonText: 'OK'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: `
                <ul class="text-start mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'OK'
        });
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>

</html>

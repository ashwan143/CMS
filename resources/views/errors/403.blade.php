<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Access Denied</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            min-height: 100vh;
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-card {
            max-width: 520px;
            width: 100%;
            background: #ffffff;
            border-radius: 16px;
            padding: 50px 35px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .error-code {
            font-size: 90px;
            font-weight: 800;
            line-height: 1;
            color: #dc3545;
        }

        .error-icon {
            font-size: 55px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="error-card">

    <div class="error-icon">
        🔒
    </div>

    <div class="error-code">
        403
    </div>

    <h2 class="mt-3">
        Access Denied
    </h2>

    <p class="text-muted mt-3">
        You don't have permission to access this page.
        Please contact your administrator if you believe this is a mistake.
    </p>

    <div class="d-flex justify-content-center gap-2 mt-4">

        <a href="{{ url()->previous() }}"
           class="btn btn-outline-secondary">
            Go Back
        </a>

        <a href="{{ route('dashboard') }}"
           class="btn btn-primary">
            Dashboard
        </a>

    </div>

</div>

</body>
</html>

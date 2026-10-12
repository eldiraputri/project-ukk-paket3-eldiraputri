<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Aspirasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6fb; }
        .card { border: 0; border-radius: 14px; box-shadow: 0 2px 12px rgba(30,41,59,.06); }
        .navbar-brand { font-weight: 700; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark shadow-sm" style="background: linear-gradient(90deg, #4f46e5, #7c3aed);">
        <div class="container">
            <span class="navbar-brand"><i class="bi bi-megaphone-fill me-2"></i>Aspirasi Siswa</span>
            <div class="d-flex align-items-center gap-3 text-white">
                <span class="small">@yield('user')</span>
                <form method="POST" action="@yield('logout')">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
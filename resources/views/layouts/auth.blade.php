<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Aspirasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: linear-gradient(135deg, #4f46e5, #7c3aed); }
        .auth-card { max-width: 420px; border: 0; border-radius: 18px; box-shadow: 0 10px 40px rgba(0,0,0,.2); }
        .icon-circle { width: 64px; height: 64px; border-radius: 50%; background: #eef2ff; color: #4f46e5;
                       display: inline-flex; align-items: center; justify-content: center; font-size: 30px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">
    <div class="card auth-card w-100">
        <div class="card-body p-4 p-md-5">
            @yield('content')
        </div>
    </div>
</body>
</html>
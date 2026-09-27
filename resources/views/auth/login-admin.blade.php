@extends('layouts.auth')
@section('title', 'Login Admin')

@section('content')
    <div class="text-center mb-4">
        <div class="icon-circle"><i class="bi bi-shield-lock-fill"></i></div>
        <h4 class="fw-bold mt-3 mb-1">Login Admin</h4>
        <p class="text-muted mb-0">Kelola aspirasi siswa</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Masuk</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('siswa.login') }}" class="text-decoration-none small">Login sebagai Siswa</a>
    </div>
@endsection
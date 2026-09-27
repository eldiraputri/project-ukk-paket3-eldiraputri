@extends('layouts.auth')
@section('title', 'Login Siswa')

@section('content')
    <div class="text-center mb-4">
        <div class="icon-circle"><i class="bi bi-mortarboard-fill"></i></div>
        <h4 class="fw-bold mt-3 mb-1">Login Siswa</h4>
        <p class="text-muted mb-0">Sampaikan aspirasimu untuk sekolah</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('siswa.login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" value="{{ old('nis') }}" class="form-control form-control-lg" required autofocus>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Masuk</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('admin.login') }}" class="text-decoration-none small">Login sebagai Admin</a>
    </div>
@endsection
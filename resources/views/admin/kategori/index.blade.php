@extends('layouts.app')
@section('title', 'Kelola Kategori')
@section('user', 'Admin: ' . auth('admin')->user()->username)
@section('logout', route('admin.logout'))

@section('content')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-plus-circle me-2"></i>Tambah Kategori</h5>
                    <form method="POST" action="{{ route('admin.kategori.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="ket_kategori" maxlength="30" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-tags-fill me-2"></i>Daftar Kategori</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Dipakai</th>
                                    <th style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoris as $kategori)
                                    <tr>
                                        <td>{{ $kategori->id_kategori }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" class="d-flex gap-2" id="edit-{{ $kategori->id_kategori }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="ket_kategori" value="{{ $kategori->ket_kategori }}" maxlength="30" class="form-control form-control-sm" required>
                                            </form>
                                        </td>
                                        <td>{{ $kategori->input_aspirasis_count }}x</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="submit" form="edit-{{ $kategori->id_kategori }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-check2"></i> Simpan
                                                </button>
                                                <form method="POST" action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                                      onsubmit="return confirm('Hapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada kategori.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
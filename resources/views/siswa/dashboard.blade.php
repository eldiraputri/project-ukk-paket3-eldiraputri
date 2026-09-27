@extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('user', 'NIS ' . auth('siswa')->user()->nis . ' | ' . auth('siswa')->user()->kelas)
@section('logout', route('siswa.logout'))

@section('content')
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-pencil-square me-2"></i>Kirim Aspirasi</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.aspirasi.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" maxlength="50" class="form-control" placeholder="Contoh: Lab Komputer" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="ket" maxlength="50" rows="3" class="form-control" placeholder="Maksimal 50 karakter" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send me-1"></i> Kirim</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Riwayat Aspirasi Saya</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Feedback Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporans as $laporan)
                                    @php
                                        $status = $laporan->aspirasi?->status;
                                        $warna = ['Menunggu' => 'secondary', 'Proses' => 'warning', 'Selesai' => 'success'][$status] ?? 'secondary';
                                    @endphp
                                    <tr>
                                        <td>{{ $laporan->kategori->ket_kategori }}</td>
                                        <td>{{ $laporan->lokasi }}</td>
                                        <td>{{ $laporan->ket }}</td>
                                        <td><span class="badge text-bg-{{ $warna }}">{{ $status }}</span></td>
                                        <td>{{ $laporan->aspirasi?->feedback ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada aspirasi yang dikirim.</td>
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
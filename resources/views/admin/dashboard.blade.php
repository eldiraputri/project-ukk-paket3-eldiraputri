@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('user', 'Admin: ' . auth('admin')->user()->username)
@section('logout', route('admin.logout'))

@section('content')
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-tags-fill"></i> Kelola Kategori</a>
    <div class="row g-3 mb-4">
        @foreach (['Menunggu' => ['secondary', 'hourglass-split'], 'Proses' => ['warning', 'arrow-repeat'], 'Selesai' => ['success', 'check-circle-fill']] as $st => $cfg)
            <div class="col-md-4">
                <div class="card p-3 d-flex flex-row align-items-center gap-3">
                    <div class="fs-1 text-{{ $cfg[0] }}"><i class="bi bi-{{ $cfg[1] }}"></i></div>
                    <div>
                        <div class="text-muted small">{{ $st }}</div>
                        <div class="fs-3 fw-bold">{{ $aspirasis->where('status', $st)->count() }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-inbox-fill me-2"></i>Daftar Aspirasi Siswa</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th style="min-width: 260px;">Tindak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aspirasis as $aspirasi)
                            @php
                                $warna = ['Menunggu' => 'secondary', 'Proses' => 'warning', 'Selesai' => 'success'][$aspirasi->status] ?? 'secondary';
                            @endphp
                            <tr>
                                <td>
                                    @if ($aspirasi->input->foto)
                                        <a href="{{ asset('storage/' . $aspirasi->input->foto) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $aspirasi->input->foto) }}" style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $aspirasi->input->siswa->nis }}<br><small class="text-muted">{{ $aspirasi->input->siswa->kelas }}</small></td>
                                <td>{{ $aspirasi->kategori->ket_kategori }}</td>
                                <td>{{ $aspirasi->input->lokasi }}</td>
                                <td>{{ $aspirasi->input->ket }}</td>
                                <td><span class="badge text-bg-{{ $warna }}">{{ $aspirasi->status }}</span></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.aspirasi.update', $aspirasi->id_aspirasi) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm mb-2">
                                            @foreach (['Menunggu', 'Proses', 'Selesai'] as $opt)
                                                <option value="{{ $opt }}" @selected($aspirasi->status === $opt)>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                        <textarea name="feedback" rows="2" class="form-control form-control-sm mb-2" placeholder="Tulis feedback...">{{ $aspirasi->feedback }}</textarea>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-check2"></i> Update</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada aspirasi masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
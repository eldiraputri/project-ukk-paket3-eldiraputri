<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();

        $kategoris = Kategori::all();

        $laporans = InputAspirasi::where('nis', $siswa->nis)
            ->with(['kategori', 'aspirasi'])
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('kategoris', 'laporans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        $siswa = Auth::guard('siswa')->user();

        $input = InputAspirasi::create([
            'nis' => $siswa->nis,
            'id_kategori' => $validated['id_kategori'],
            'lokasi' => $validated['lokasi'],
            'ket' => $validated['ket'],
        ]);

        Aspirasi::create([
            'id_pelaporan' => $input->id_pelaporan,
            'id_kategori' => $validated['id_kategori'],
            'status' => 'Menunggu',
        ]);

        return back()->with('success', 'Aspirasi berhasil dikirim, menunggu diproses admin.');
    }
}
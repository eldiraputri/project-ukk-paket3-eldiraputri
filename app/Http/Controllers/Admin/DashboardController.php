<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::with(['input.siswa', 'kategori'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('aspirasis'));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string',
        ]);

        $aspirasi->update($validated);

        return back()->with('success', 'Status aspirasi berhasil diperbarui.');
    }
}
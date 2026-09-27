<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Sarana', 'Prasarana', 'Kebersihan', 'Lainnya'] as $nama) {
            Kategori::create(['ket_kategori' => $nama]);
        }
    }
}
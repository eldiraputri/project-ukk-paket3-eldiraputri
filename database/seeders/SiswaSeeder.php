<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create(['nis' => '1001', 'kelas' => 'XII RPL']);
        Siswa::create(['nis' => '1002', 'kelas' => 'XII TKJ']);
    }
}
<?php

namespace Database\Seeders;

use App\Models\JadwalKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('jadwal_kuliah')->count());

        if ($missingRecords > 0) {
            DB::table('jadwal_kuliah')->insert(JadwalKuliah::factory()->count($missingRecords)->raw());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('presensi')->count());

        if ($missingRecords > 0) {
            DB::table('presensi')->insert(Presensi::factory()->count($missingRecords)->raw());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('matakuliah')->count());

        if ($missingRecords > 0) {
            DB::table('matakuliah')->insert(Matakuliah::factory()->count($missingRecords)->raw());
        }
    }
}

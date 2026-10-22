<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('dosen')->count());

        if ($missingRecords > 0) {
            DB::table('dosen')->insert(Dosen::factory()->count($missingRecords)->raw());
        }
    }
}

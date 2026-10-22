<?php

namespace Database\Seeders;

use App\Models\Kr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('krs')->count());

        if ($missingRecords > 0) {
            DB::table('krs')->insert(Kr::factory()->count($missingRecords)->raw());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Tanskrip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanskripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('tanskrip')->count());

        if ($missingRecords > 0) {
            DB::table('tanskrip')->insert(Tanskrip::factory()->count($missingRecords)->raw());
        }
    }
}

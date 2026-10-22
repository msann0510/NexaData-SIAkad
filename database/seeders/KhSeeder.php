<?php

namespace Database\Seeders;

use App\Models\Kh;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('khs')->count());

        if ($missingRecords > 0) {
            DB::table('khs')->insert(Kh::factory()->count($missingRecords)->raw());
        }
    }
}

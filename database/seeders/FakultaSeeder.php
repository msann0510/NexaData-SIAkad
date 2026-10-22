<?php

namespace Database\Seeders;

use App\Models\Fakulta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('fakultas')->count());

        if ($missingRecords > 0) {
            DB::table('fakultas')->insert(Fakulta::factory()->count($missingRecords)->raw());
        }
    }
}

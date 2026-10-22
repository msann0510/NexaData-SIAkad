<?php

namespace Database\Seeders;

use App\Models\Kela;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missingRecords = max(0, 100 - DB::table('kelas')->count());

        if ($missingRecords > 0) {
            DB::table('kelas')->insert(Kela::factory()->count($missingRecords)->raw());
        }
    }
}

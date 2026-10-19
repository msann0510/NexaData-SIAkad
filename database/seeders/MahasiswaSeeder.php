<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    private const TOTAL_RECORDS = 100_000;

    private const BATCH_SIZE = 100;

    public function run(): void
    {
        for ($remaining = self::TOTAL_RECORDS; $remaining > 0; $remaining -= self::BATCH_SIZE) {
            $batchSize = min(self::BATCH_SIZE, $remaining);

            DB::table('mahasiswa')->insert(
                Mahasiswa::factory()->count($batchSize)->raw()
            );
        }
    }
}

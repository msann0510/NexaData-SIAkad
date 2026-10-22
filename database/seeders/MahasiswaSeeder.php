<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class MahasiswaSeeder extends Seeder
{
    private const TOTAL_RECORDS = 100_000;

    private const BATCH_SIZE = 100;

    public function run(): void
    {
        $prodiIds = DB::table('prodi')->orderBy('id_prodi')->pluck('id_prodi')->all();

        if ($prodiIds === []) {
            throw new RuntimeException('Seed at least one program of study before creating mahasiswa.');
        }

        $missingRecords = max(0, self::TOTAL_RECORDS - DB::table('mahasiswa')->count());
        $recordsPerProdi = intdiv($missingRecords, count($prodiIds));
        $extraRecords = $missingRecords % count($prodiIds);

        foreach ($prodiIds as $index => $prodiId) {
            $recordsForProdi = $recordsPerProdi + ($index < $extraRecords ? 1 : 0);

            for ($remaining = $recordsForProdi; $remaining > 0; $remaining -= self::BATCH_SIZE) {
                $batchSize = min(self::BATCH_SIZE, $remaining);

                DB::table('mahasiswa')->insert(
                    Mahasiswa::factory()
                        ->count($batchSize)
                        ->state(['id_prodi' => $prodiId])
                        ->raw()
                );
            }
        }
    }
}

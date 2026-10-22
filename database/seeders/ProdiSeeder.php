<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    private const TOTAL_RECORDS = 20;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingProdiIds = DB::table('prodi')->pluck('id_prodi')->all();
        $missingProdiIds = array_values(array_diff(
            array_map(
                fn (int $number): string => sprintf('P%03d', $number),
                range(1, self::TOTAL_RECORDS)
            ),
            $existingProdiIds
        ));

        if ($missingProdiIds !== []) {
            $records = [];

            foreach ($missingProdiIds as $idProdi) {
                $records[] = Prodi::factory()
                    ->state(['id_prodi' => $idProdi])
                    ->raw();
            }

            DB::table('prodi')->insert($records);
        }
    }
}

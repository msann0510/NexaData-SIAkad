<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! DB::table('mahasiswa')->exists()) {
            throw new RuntimeException('Import existing mahasiswa records before running the database seeder.');
        }

        $this->call([
            UserSeeder::class,
            FakultaSeeder::class,
            ProdiSeeder::class,
            DosenSeeder::class,
            MatakuliahSeeder::class,
            KelaSeeder::class,
            JadwalKuliahSeeder::class,
            KhSeeder::class,
            KrSeeder::class,
            PresensiSeeder::class,
            TanskripSeeder::class,
        ]);
    }
}

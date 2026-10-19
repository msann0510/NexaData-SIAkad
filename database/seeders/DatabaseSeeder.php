<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if (! DB::table('prodi')->exists()) {
            DB::table('fakultas')->insertOrIgnore([
                'id_fakultas' => 'F001',
                'nama_fakultas' => 'Fakultas Sains dan Teknologi',
                'no_gedung' => 1,
            ]);

            DB::table('prodi')->insertOrIgnore([
                'id_prodi' => 'P001',
                'nama_prodi' => 'Informatika',
                'id_fakultas' => 'F001',
            ]);
        }

        $this->call(MahasiswaSeeder::class);
    }
}

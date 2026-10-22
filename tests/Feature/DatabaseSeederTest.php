<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\Fakulta;
use App\Models\JadwalKuliah;
use App\Models\Kela;
use App\Models\Kh;
use App\Models\Kr;
use App\Models\Matakuliah;
use App\Models\Presensi;
use App\Models\Prodi;
use App\Models\Tanskrip;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_seeds_one_hundred_records_per_non_student_table_without_changing_students(): void
    {
        DB::table('fakultas')->insert([
            'id_fakultas' => 'FTEST',
            'nama_fakultas' => 'Fakultas Test',
            'no_gedung' => 1,
        ]);
        DB::table('prodi')->insert([
            'id_prodi' => 'P001',
            'nama_prodi' => 'Informatika Test',
            'id_fakultas' => 'FTEST',
        ]);
        DB::table('mahasiswa')->insert([
            'nim' => 'NIMTEST001',
            'nama_mahasiswa' => 'Mahasiswa Test',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Alamat Test',
            'id_prodi' => 'P001',
        ]);

        $this->seed(DatabaseSeeder::class);

        foreach ([
            'users',
            'fakultas',
            'dosen',
            'matakuliah',
            'kelas',
            'jadwal_kuliah',
            'khs',
            'krs',
            'presensi',
            'tanskrip',
        ] as $table) {
            $this->assertDatabaseCount($table, 100);
        }

        $this->assertDatabaseCount('prodi', 20);
        $this->assertDatabaseHas('prodi', ['id_prodi' => 'P020']);
        $this->assertSame(
            array_map(fn (int $number): string => sprintf('P%03d', $number), range(1, 20)),
            DB::table('prodi')->orderBy('id_prodi')->pluck('id_prodi')->all()
        );
        $this->assertDatabaseCount('mahasiswa', 1);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

        $this->seed(DatabaseSeeder::class);

        foreach ([
            'users',
            'fakultas',
            'dosen',
            'matakuliah',
            'kelas',
            'jadwal_kuliah',
            'khs',
            'krs',
            'presensi',
            'tanskrip',
        ] as $table) {
            $this->assertDatabaseCount($table, 100);
        }

        $this->assertDatabaseCount('prodi', 20);
        $this->assertDatabaseCount('mahasiswa', 1);

        foreach ([
            [Fakulta::class, 'fakultas', 'id_fakultas'],
            [Prodi::class, 'prodi', 'id_prodi'],
            [Dosen::class, 'dosen', 'id_dosen'],
            [Matakuliah::class, 'matakuliah', 'kode_mk'],
            [Kela::class, 'kelas', 'id_kelas'],
            [JadwalKuliah::class, 'jadwal_kuliah', 'id_jadwal'],
            [Kh::class, 'khs', 'id_khs'],
            [Kr::class, 'krs', 'id_krs'],
            [Presensi::class, 'presensi', 'id_presensi'],
            [Tanskrip::class, 'tanskrip', 'id_transkrip'],
        ] as [$modelClass, $table, $primaryKey]) {
            $model = $modelClass::factory()->create();

            $this->assertDatabaseHas($table, [$primaryKey => $model->getKey()]);
        }
    }

    public function test_it_requires_existing_mahasiswa_before_seeding_other_tables(): void
    {
        try {
            $this->seed(DatabaseSeeder::class);
            $this->fail('The database seeder should require existing mahasiswa records.');
        } catch (RuntimeException $exception) {
            $this->assertSame(
                'Import existing mahasiswa records before running the database seeder.',
                $exception->getMessage()
            );
        }

        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseCount('fakultas', 0);
    }
}

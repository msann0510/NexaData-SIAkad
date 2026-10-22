<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Database\Seeders\MahasiswaSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MahasiswaSeederTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('fakultas', function (Blueprint $table): void {
            $table->string('id_fakultas', 10)->primary();
            $table->string('nama_fakultas', 100);
            $table->integer('no_gedung');
        });

        Schema::create('prodi', function (Blueprint $table): void {
            $table->string('id_prodi', 10)->primary();
            $table->string('nama_prodi', 100);
            $table->string('id_fakultas', 10);
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas');
        });

        Schema::create('mahasiswa', function (Blueprint $table): void {
            $table->string('nim', 20)->primary();
            $table->string('nama_mahasiswa', 100);
            $table->char('jenis_kelamin', 1);
            $table->date('tanggal_lahir');
            $table->string('alamat', 100);
            $table->string('id_prodi', 10);
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');
        });

    }

    public function test_mahasiswa_factory_creates_a_model_with_its_string_primary_key(): void
    {
        $this->createProdi();

        $mahasiswa = Mahasiswa::factory()->create();

        $this->assertSame('nim', $mahasiswa->getKeyName());
        $this->assertNotEmpty($mahasiswa->getKey());
        $this->assertDatabaseHas('mahasiswa', ['nim' => $mahasiswa->getKey()]);
    }

    public function test_mahasiswa_seeder_distributes_one_hundred_thousand_records_across_all_programs(): void
    {
        $this->createProdiRecords(100);

        $this->seed(MahasiswaSeeder::class);

        $this->assertDatabaseCount('mahasiswa', 100_000);
        $this->assertSame(
            0,
            DB::table('mahasiswa')
                ->select('id_prodi')
                ->groupBy('id_prodi')
                ->havingRaw('COUNT(*) != 1000')
                ->count()
        );

        $this->seed(MahasiswaSeeder::class);

        $this->assertDatabaseCount('mahasiswa', 100_000);
    }

    private function createProdi(): void
    {
        $this->createProdiRecords(1);
    }

    private function createProdiRecords(int $count): void
    {
        DB::table('fakultas')->insert([
            'id_fakultas' => 'F001',
            'nama_fakultas' => 'Fakultas Sains dan Teknologi',
            'no_gedung' => 1,
        ]);

        $prodis = [];

        for ($index = 1; $index <= $count; $index++) {
            $prodis[] = [
                'id_prodi' => sprintf('P%03d', $index),
                'nama_prodi' => 'Program Studi '.$index,
                'id_fakultas' => 'F001',
            ];
        }

        DB::table('prodi')->insert($prodis);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Database\Seeders\DatabaseSeeder;
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

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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

    public function test_database_seeder_creates_exactly_one_hundred_thousand_mahasiswa(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('mahasiswa', 100_000);
        $this->assertDatabaseHas('mahasiswa', ['id_prodi' => 'P001']);
    }

    private function createProdi(): void
    {
        DB::table('fakultas')->insert([
            'id_fakultas' => 'F001',
            'nama_fakultas' => 'Fakultas Sains dan Teknologi',
            'no_gedung' => 1,
        ]);

        DB::table('prodi')->insert([
            'id_prodi' => 'P001',
            'nama_prodi' => 'Informatika',
            'id_fakultas' => 'F001',
        ]);
    }
}

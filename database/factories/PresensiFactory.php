<?php

namespace Database\Factories;

use App\Models\Presensi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Presensi>
 */
class PresensiFactory extends Factory
{
    /**
     * @var list<string>|null
     */
    private ?array $nimList = null;

    /**
     * @var list<string>|null
     */
    private ?array $kelasIds = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nimList = $this->nimList ??= DB::table('mahasiswa')->pluck('nim')->all();
        $kelasIds = $this->kelasIds ??= DB::table('kelas')->pluck('id_kelas')->all();

        if ($nimList === [] || $kelasIds === []) {
            throw new RuntimeException('Existing mahasiswa records and classes are required before seeding attendance.');
        }

        return [
            'id_presensi' => fake()->unique()->numerify('PRS########'),
            'nim' => fake()->randomElement($nimList),
            'id_kelas' => fake()->randomElement($kelasIds),
            'tanggal' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'pertemuan_ke' => fake()->numberBetween(1, 16),
            'status_hadir' => fake()->randomElement(['Hadir', 'Izin', 'Sakit', 'Alpa']),
        ];
    }
}

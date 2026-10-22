<?php

namespace Database\Factories;

use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<JadwalKuliah>
 */
class JadwalKuliahFactory extends Factory
{
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
        $kelasIds = $this->kelasIds ??= DB::table('kelas')->pluck('id_kelas')->all();

        if ($kelasIds === []) {
            throw new RuntimeException('Seed at least one class before creating schedules.');
        }

        [$jamMulai, $jamSelesai] = fake()->randomElement([
            ['07:00:00', '08:40:00'],
            ['09:00:00', '10:40:00'],
            ['13:00:00', '14:40:00'],
            ['15:00:00', '16:40:00'],
        ]);

        return [
            'id_jadwal' => fake()->unique()->numerify('JDW########'),
            'id_kelas' => fake()->randomElement($kelasIds),
            'hari' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'ruangan' => fake()->randomElement(['A', 'B', 'C']).fake()->numberBetween(101, 505),
        ];
    }
}

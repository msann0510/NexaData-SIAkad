<?php

namespace Database\Factories;

use App\Models\Kr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Kr>
 */
class KrFactory extends Factory
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
            throw new RuntimeException('Existing mahasiswa records and classes are required before seeding KRS.');
        }

        return [
            'id_krs' => fake()->unique()->numerify('KRS########'),
            'nim' => fake()->randomElement($nimList),
            'id_kelas' => fake()->randomElement($kelasIds),
            'semester' => fake()->numberBetween(1, 8),
            'tanggal_krs' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'status_krs' => fake()->randomElement(['Disetujui', 'Menunggu', 'Ditolak']),
        ];
    }
}

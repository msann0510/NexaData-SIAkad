<?php

namespace Database\Factories;

use App\Models\Tanskrip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Tanskrip>
 */
class TanskripFactory extends Factory
{
    /**
     * @var list<string>|null
     */
    private ?array $nimList = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nimList = $this->nimList ??= DB::table('mahasiswa')->pluck('nim')->all();

        if ($nimList === []) {
            throw new RuntimeException('Existing mahasiswa records are required before seeding transcripts.');
        }

        return [
            'id_transkrip' => fake()->unique()->numerify('TRS########'),
            'nim' => fake()->randomElement($nimList),
            'ipk' => number_format(fake()->randomFloat(2, 0, 4), 2, '.', ''),
            'total_sks_lulus' => fake()->numberBetween(100, 144),
            'tanggal_cetak' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];
    }
}

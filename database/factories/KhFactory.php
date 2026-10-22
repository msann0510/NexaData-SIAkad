<?php

namespace Database\Factories;

use App\Models\Kh;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Kh>
 */
class KhFactory extends Factory
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
            throw new RuntimeException('Existing mahasiswa records are required before seeding KHS.');
        }

        return [
            'id_khs' => fake()->unique()->numerify('KHS########'),
            'nim' => fake()->randomElement($nimList),
            'semester' => fake()->numberBetween(1, 8),
            'ips' => number_format(fake()->randomFloat(2, 0, 4), 2, '.', ''),
            'total_sks' => fake()->numberBetween(12, 24),
        ];
    }
}

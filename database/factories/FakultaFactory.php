<?php

namespace Database\Factories;

use App\Models\Fakulta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fakulta>
 */
class FakultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_fakultas' => fake()->unique()->numerify('FAK########'),
            'nama_fakultas' => 'Fakultas '.fake()->words(2, true),
            'no_gedung' => fake()->numberBetween(1, 20),
        ];
    }
}

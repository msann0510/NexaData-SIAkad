<?php

namespace Database\Factories;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Prodi>
 */
class ProdiFactory extends Factory
{
    /**
     * @var list<string>|null
     */
    private ?array $fakultasIds = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakultasIds = $this->fakultasIds ??= DB::table('fakultas')->pluck('id_fakultas')->all();

        if ($fakultasIds === []) {
            throw new RuntimeException('Seed at least one faculty before creating programs of study.');
        }

        return [
            'id_prodi' => sprintf('P%03d', fake()->unique()->numberBetween(21, 999)),
            'nama_prodi' => fake()->words(2, true),
            'id_fakultas' => fake()->randomElement($fakultasIds),
        ];
    }
}

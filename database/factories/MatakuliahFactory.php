<?php

namespace Database\Factories;

use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * @var list<string>|null
     */
    private ?array $prodiIds = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prodiIds = $this->prodiIds ??= DB::table('prodi')->pluck('id_prodi')->all();

        if ($prodiIds === []) {
            throw new RuntimeException('Seed at least one program of study before creating courses.');
        }

        return [
            'kode_mk' => fake()->unique()->numerify('MK########'),
            'nama_mk' => fake()->words(3, true),
            'sks' => fake()->randomElement([2, 3, 4]),
            'semester' => fake()->numberBetween(1, 8),
            'id_prodi' => fake()->randomElement($prodiIds),
        ];
    }
}

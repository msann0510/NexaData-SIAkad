<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Dosen>
 */
class DosenFactory extends Factory
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
            throw new RuntimeException('Seed at least one program of study before creating lecturers.');
        }

        return [
            'id_dosen' => fake()->unique()->numerify('DSN########'),
            'nama_dosen' => fake()->name(),
            'id_prodi' => fake()->randomElement($prodiIds),
        ];
    }
}

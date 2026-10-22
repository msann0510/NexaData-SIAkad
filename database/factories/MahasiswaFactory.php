<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;
use RuntimeException;

/**
 * @extends Factory<Mahasiswa>
 */
class MahasiswaFactory extends Factory
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
        $prodiIds = $this->prodiIds ??= Prodi::query()
            ->orderBy('id_prodi')
            ->pluck('id_prodi')
            ->all();

        if ($prodiIds === []) {
            throw new RuntimeException('Seed at least one program of study before creating mahasiswa.');
        }

        return [
            'nim' => fake()->unique()->numerify('####################'),
            'nama_mahasiswa' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tanggal_lahir' => fake()->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'alamat' => fake()->text(100),
            'id_prodi' => fake()->randomElement($prodiIds),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Kela;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * @extends Factory<Kela>
 */
class KelaFactory extends Factory
{
    /**
     * @var list<string>|null
     */
    private ?array $kodeMataKuliah = null;

    /**
     * @var list<string>|null
     */
    private ?array $dosenIds = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kodeMataKuliah = $this->kodeMataKuliah ??= DB::table('matakuliah')->pluck('kode_mk')->all();
        $dosenIds = $this->dosenIds ??= DB::table('dosen')->pluck('id_dosen')->all();

        if ($kodeMataKuliah === [] || $dosenIds === []) {
            throw new RuntimeException('Seed courses and lecturers before creating classes.');
        }

        return [
            'id_kelas' => fake()->unique()->numerify('KLS########'),
            'nama_kelas' => fake()->randomElement(['A', 'B', 'C', 'D']).'-'.fake()->numerify('##'),
            'kode_mk' => fake()->randomElement($kodeMataKuliah),
            'id_dosen' => fake()->randomElement($dosenIds),
        ];
    }
}

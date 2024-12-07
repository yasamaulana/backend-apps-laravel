<?php

namespace Database\Factories;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Obat::class;

    public function definition()
    {
        return [
            'nama_obat' => $this->faker->unique()->word,
            'kode_obat' => $this->faker->unique()->regexify('OB[0-9]{3}'),
            'jenis_obat' => $this->faker->randomElement(['Tablet', 'Kapsul', 'Sirup']),
            'stok' => $this->faker->numberBetween(10, 100),
            'harga' => $this->faker->randomFloat(2, 5000, 50000),
        ];
    }
}
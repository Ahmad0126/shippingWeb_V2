<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Layanan>
 */
class LayananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_layanan' => fake()->word(),
            'kapasitas' => fake()->randomNumber(2),
            'waktu' => '2-5',
            'ongkir' => fake()->randomNumber(4, true),
        ];
    }
}

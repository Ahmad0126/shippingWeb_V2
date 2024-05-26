<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cabang>
 */
class CabangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_cabang' => fake()->ean8(),
            'alamat' => fake()->address(),
            'kode_pos' => fake()->postcode(),
            'kota' => fake()->city(),
            'fasilitas' => Arr::random(['Warehouse','Office','Sorting Center','Gateway']),
        ];
    }
}

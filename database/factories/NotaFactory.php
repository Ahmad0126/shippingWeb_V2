<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nota>
 */
class NotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_nota' => fake()->isbn10(),
            'nama_pengirim' => fake()->name(),
            'alamat_pengirim' => fake()->address(),
            'no_hp_pengirim' => fake()->phoneNumber(),
            'total' => 0,
            'pembayaran' => Arr::random(['Tunai', 'Kredit']),
        ];
    }
}

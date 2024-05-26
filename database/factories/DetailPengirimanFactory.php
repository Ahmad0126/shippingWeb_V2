<?php

namespace Database\Factories;

use App\Models\Pengiriman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPengiriman>
 */
class DetailPengirimanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengiriman' => Pengiriman::factory(),
            'tanggal_dikirim' => fake()->date().' '.fake()->time(),
            'nama_penerima' => fake()->name(),
            'no_hp_penerima' => fake()->phoneNumber(),
            'deskripsi' => fake()->sentence(3),
            'berat' => fake()->randomNumber(2),
            'koli' => fake()->randomNumber(2),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Layanan;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengiriman>
 */
class PengirimanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_pengiriman' => fake()->ean13(),
            'alamat_tujuan' => fake()->address(),
            'kode_pos' => fake()->postcode(),
            'id_layanan' => Layanan::factory(),
            'ongkir' => 0,
            'id_nota' => Nota::factory(),
            'estimasi' => '2-5'
        ];
    }
}

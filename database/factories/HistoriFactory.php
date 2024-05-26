<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\Pengiriman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histori>
 */
class HistoriFactory extends Factory
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
            'tanggal' => fake()->date().' '.fake()->time(),
            'deskripsi' => fake()->sentence(4),
            'status' => Arr::random(['registered','checkout','forwarded','received_sort','received_origin','received_warehouse','delivery','delivered']),
            'id_user' => User::factory(),
            'id_cabang' => Cabang::factory(),
        ];
    }
}

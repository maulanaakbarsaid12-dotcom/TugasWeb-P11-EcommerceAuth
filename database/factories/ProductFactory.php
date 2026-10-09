<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $jenis = ['Kemeja', 'Sepatu', 'Tas Ransel', 'Jam Tangan', 'Headphone', 'Keyboard', 'Mouse', 'Botol Minum', 'Lampu Meja', 'Jaket', 'Kaos', 'Powerbank'];
        $varian = ['Premium', 'Classic', 'Pro', 'Slim', 'Eco', 'Sport', 'Mini', 'Max'];

        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'name' => fake()->randomElement($jenis) . ' ' . fake()->randomElement($varian),
            'description' => fake()->sentences(3, true),
            'price' => fake()->numberBetween(20, 5000) * 1000,
            'stock' => fake()->numberBetween(0, 200),
            'is_active' => fake()->boolean(90),
        ];
    }
}
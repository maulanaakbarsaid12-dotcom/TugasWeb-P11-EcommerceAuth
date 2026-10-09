<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Elektronik', 'Fashion Pria', 'Fashion Wanita', 'Aksesoris',
                'Peralatan Rumah', 'Olahraga', 'Buku & Alat Tulis', 'Kesehatan',
            ]),
        ];
    }
}
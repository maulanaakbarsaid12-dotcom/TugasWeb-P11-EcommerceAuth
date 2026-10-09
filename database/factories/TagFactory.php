<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Terlaris', 'Diskon', 'Baru', 'Gratis Ongkir', 'Premium',
                'Hemat', 'Limited', 'Rekomendasi', 'Garansi', 'Pilihan Editor',
            ]),
        ];
    }
}
<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'quantity' => fake()->numberBetween(1, 3),
            'price' => $product->price,
        ];
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tiga akun uji untuk tiga role. Password semuanya: password
        $admin  = User::factory()->create(['name' => 'Admin Toko',  'email' => 'admin@example.com',  'role' => 'admin']);
        $editor = User::factory()->create(['name' => 'Editor Toko', 'email' => 'editor@example.com', 'role' => 'editor']);
        $user   = User::factory()->create(['name' => 'Budi User',   'email' => 'user@example.com',   'role' => 'user']);
        User::factory(7)->create();

        $tags = collect(['Terlaris', 'Diskon', 'Baru', 'Stok Terbatas', 'Gratis Ongkir'])
            ->map(fn ($name) => Tag::create(['name' => $name]));

        $brands = ['Aurora', 'Nusantara', 'Prima', 'Zenith', 'Bintang', 'Lumina', 'Mega', 'Karya'];

        $catalog = [
            'Elektronik' => ['Laptop 14 Inci', 'Smartphone 5G', 'Headphone Bluetooth', 'Smart TV 43 Inci', 'Power Bank 20000 mAh', 'Mouse Wireless', 'Keyboard Mekanik', 'Speaker Bluetooth', 'Smartwatch', 'Webcam Full HD'],
            'Fashion' => ['Kaos Polos', 'Kemeja Flanel', 'Celana Jeans', 'Jaket Hoodie', 'Sepatu Sneakers', 'Tas Ransel', 'Topi Baseball', 'Jam Tangan Analog', 'Sandal Jepit', 'Dompet Kulit'],
            'Rumah Tangga' => ['Rice Cooker', 'Blender', 'Setrika Uap', 'Panci Set', 'Dispenser Air', 'Kipas Angin', 'Lampu LED 12 Watt', 'Vacuum Cleaner', 'Teko Listrik', 'Rak Sepatu'],
            'Olahraga' => ['Matras Yoga', 'Dumbbell 5 Kg', 'Raket Badminton', 'Bola Futsal', 'Sepeda Lipat', 'Sepatu Lari', 'Tali Skipping', 'Botol Minum', 'Tenda Camping', 'Sarung Tangan Gym'],
            'Buku' => ['Novel Fiksi', 'Buku Pemrograman PHP', 'Kamus Inggris-Indonesia', 'Buku Resep Masakan', 'Komik Serial', 'Buku Motivasi', 'Atlas Dunia', 'Buku Matematika SMA', 'Biografi Tokoh', 'Buku Gambar Anak'],
            'Kecantikan' => ['Sabun Wajah', 'Pelembap Wajah', 'Tabir Surya SPF 50', 'Lipstik Matte', 'Serum Vitamin C', 'Sampo Anti Ketombe', 'Masker Wajah', 'Parfum 50 ml', 'Bedak Tabur', 'Pembersih Makeup'],
        ];

        $priceRange = [
            'Elektronik'   => [150000, 9000000],
            'Fashion'      => [50000, 800000],
            'Rumah Tangga' => [30000, 2500000],
            'Olahraga'     => [40000, 3500000],
            'Buku'         => [30000, 250000],
            'Kecantikan'   => [20000, 450000],
        ];

        foreach ($catalog as $categoryName => $items) {
            $category = Category::create(['name' => $categoryName]);
            [$min, $max] = $priceRange[$categoryName];

            foreach ($items as $item) {
                $product = Product::factory()->create([
                    'category_id' => $category->id,
                    'user_id' => $admin->id,
                    'name' => fake()->randomElement($brands) . ' ' . $item,
                    'price' => fake()->numberBetween(intdiv($min, 1000), intdiv($max, 1000)) * 1000,
                ]);

                $product->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
            }
        }

        // 25 pesanan milik user biasa, masing-masing 1 sampai 4 item
        $buyers = User::where('role', 'user')->get();
        $products = Product::all();

        foreach (range(1, 25) as $i) {
            $order = Order::factory()->create(['user_id' => $buyers->random()->id]);

            $products->random(rand(1, 4))->each(function ($product) use ($order) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $product->price,
                ]);
            });
        }

        // Post milik tiap role, dipakai untuk menguji PostPolicy nanti
        Post::factory(4)->create(['user_id' => $user->id]);
        Post::factory(3)->create(['user_id' => $editor->id]);
        Post::factory(3)->create(['user_id' => $admin->id]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('role', 'seller')->first();
        $categories = Category::pluck('id')->toArray();

        $products = [
            [
                'name' => 'Sepatu Lari Sport',
                'description' => 'Sepatu lari ringan dan nyaman untuk aktivitas olahraga.',
                'price' => 350000,
                'stock' => 25,
                'image' => 'https://picsum.photos/400/300?random=11',
            ],
            [
                'name' => 'Jaket Hoodie Casual',
                'description' => 'Hoodie hangat cocok untuk sehari-hari.',
                'price' => 250000,
                'stock' => 18,
                'image' => 'https://picsum.photos/400/300?random=12',
            ],
            [
                'name' => 'Tas Ransel Outdoor',
                'description' => 'Tas ransel kuat untuk travelling dan hiking.',
                'price' => 420000,
                'stock' => 10,
                'image' => 'https://picsum.photos/400/300?random=13',
            ],
            [
                'name' => 'Jam Tangan Digital',
                'description' => 'Jam tangan digital modern dan tahan air.',
                'price' => 180000,
                'stock' => 30,
                'image' => 'https://picsum.photos/400/300?random=14',
            ],
            [
                'name' => 'Headphone Wireless',
                'description' => 'Headphone bluetooth dengan suara jernih.',
                'price' => 520000,
                'stock' => 12,
                'image' => 'https://picsum.photos/400/300?random=15',
            ],
            [
                'name' => 'Botol Minum Stainless',
                'description' => 'Botol minum tahan panas dan dingin.',
                'price' => 120000,
                'stock' => 40,
                'image' => 'https://picsum.photos/400/300?random=16',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'user_id' => $seller->id,
                'category_id' => $categories[array_rand($categories)],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
            ]);
        }
    }
}

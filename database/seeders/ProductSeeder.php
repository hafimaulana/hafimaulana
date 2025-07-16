<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Arabica Gayo',
                'description' => 'Kopi Arabika dari dataran tinggi Gayo, Aceh. Memiliki rasa yang kompleks dengan aroma floral dan citrus yang menyegarkan.',
                'price' => 85000,
                'origin' => 'Gayo, Aceh',
                'roast_level' => 'Medium',
                'stock' => 50,
                'is_available' => true,
            ],
            [
                'name' => 'Robusta Lampung',
                'description' => 'Kopi Robusta dari Lampung dengan karakteristik rasa yang kuat dan pahit, cocok untuk espresso.',
                'price' => 65000,
                'origin' => 'Lampung',
                'roast_level' => 'Dark',
                'stock' => 75,
                'is_available' => true,
            ],
            [
                'name' => 'Arabica Toraja',
                'description' => 'Kopi premium dari Toraja, Sulawesi Selatan. Memiliki rasa yang kaya dengan sentuhan rempah dan cokelat.',
                'price' => 95000,
                'origin' => 'Toraja, Sulawesi Selatan',
                'roast_level' => 'Medium-Dark',
                'stock' => 30,
                'is_available' => true,
            ],
            [
                'name' => 'Robusta Bali',
                'description' => 'Kopi Robusta dari Bali dengan karakteristik rasa yang seimbang dan aroma yang harum.',
                'price' => 70000,
                'origin' => 'Bali',
                'roast_level' => 'Medium',
                'stock' => 60,
                'is_available' => true,
            ],
            [
                'name' => 'Arabica Flores',
                'description' => 'Kopi Arabika dari Flores, NTT. Memiliki rasa yang unik dengan sentuhan buah-buahan tropis.',
                'price' => 90000,
                'origin' => 'Flores, NTT',
                'roast_level' => 'Light',
                'stock' => 40,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

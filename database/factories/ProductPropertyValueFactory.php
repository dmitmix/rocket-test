<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Property;
use App\Models\ProductPropertyValue;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Создаем 3 свойства
        $properties = Property::factory()->count(3)->create();

        // Создаем 10 продуктов и связываем их со свойствами
        Product::factory()->count(10)->create()->each(function($product) use ($properties, $faker) {
            foreach ($properties as $property) {
                ProductPropertyValue::create([
                    'product_id' => $product->id,
                    'property_id' => $property->id,
                    'value' => $faker->randomElement(['Red', 'Blue', 'Large', 'Small', 'Cotton', 'Wool']),
                ]);
            }
        });
    }
}

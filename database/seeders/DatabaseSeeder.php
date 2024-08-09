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

        // Создаем 100 продуктов
        $products = Product::factory(100)->create();

        // Создаем 3 свойства
        $properties = Property::factory(3)->create();

        // Создаем значения свойств для каждого продукта
        foreach ($products as $product) {
            foreach ($properties as $property) {
                ProductPropertyValue::create([
                    'product_id' => $product->id,
                    'property_id' => $property->id,
                    'value' => $faker->randomElement(['Red', 'Blue', 'Large', 'Small', 'Cotton', 'Wool']),
                ]);
            }
        }
    }
}

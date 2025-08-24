<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'brand_id' => 1,
            'model_id' => 1,
            'photo'    => '/images/toyota-camry.jpg',
            'price'    => 2500000,
        ]);

        Car::create([
            'brand_id' => 1,
            'model_id' => 2,
            'photo'    => '/images/toyota-corolla.jpg',
            'price'    => 1800000,
        ]);

        Car::create([
            'brand_id' => 2,
            'model_id' => 3,
            'photo'    => '/images/honda-civic.jpg',
            'price'    => 1600000,
        ]);

        Car::create([
            'brand_id' => 2,
            'model_id' => 4,
            'photo'    => '/images/honda-accord.jpg',
            'price'    => 2200000,
        ]);

        Car::create([
            'brand_id' => 3,
            'model_id' => 5,
            'photo'    => '/images/bmw-x5.jpg',
            'price'    => 4500000,
        ]);

        Car::create([
            'brand_id' => 3,
            'model_id' => 6,
            'photo'    => '/images/bmw-3series.jpg',
            'price'    => 3200000,
        ]);

        Car::create([
            'brand_id' => 4,
            'model_id' => 7,
            'photo'    => '/images/mercedes-eclass.jpg',
            'price'    => 3800000,
        ]);

        Car::create([
            'brand_id' => 4,
            'model_id' => 8,
            'photo'    => '/images/mercedes-cclass.jpg',
            'price'    => 2900000,
        ]);
    }
}

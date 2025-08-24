<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarModel::create(['name' => 'Camry', 'brand_id' => 1]);
        CarModel::create(['name' => 'Corolla', 'brand_id' => 1]);
        CarModel::create(['name' => 'Civic', 'brand_id' => 2]);
        CarModel::create(['name' => 'Accord', 'brand_id' => 2]);
        CarModel::create(['name' => 'X5', 'brand_id' => 3]);
        CarModel::create(['name' => '3 Series', 'brand_id' => 3]);
        CarModel::create(['name' => 'E-Class', 'brand_id' => 4]);
        CarModel::create(['name' => 'C-Class', 'brand_id' => 4]);
    }
}

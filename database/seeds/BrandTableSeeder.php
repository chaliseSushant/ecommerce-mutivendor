<?php

use App\Brand;
use App\Store;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 7; $x++) {
            $brand = new Brand();
            $brand->name = 'Brand ' . $x;
            $brand->save();
        }
    }
}

<?php

use App\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ///$this->call(RoleTableSeeder::class);
        ///$this->call(UserTableSeeder::class);
        ///$this->call(PrivilegeTableSeeder::class);
        //$this->call(VendorTableSeeder::class);
        //$this->call(TagTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        //$this->call(BrandTableSeeder::class);
        ///$this->call(ProvinceTableSeeder::class);
        ///$this->call(DistrictTableSeeder::class);
        //$this->call(CustomerTableSeeder::class);
        //$this->call(ProductTableSeeder::class);
        ///$this->call(HomepageSeeder::class);
        ///$this->call(PageTableSeeder::class);

        /*$setting = new Setting();
        $setting->save();*/
    }
}

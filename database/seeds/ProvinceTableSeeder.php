<?php

use App\Province;
use App\District;
use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,"Province 1"],
            [2,"Province 2"],
            [3,"Bagmati"],
            [4,"Gandaki"],
            [5,"Province 5"],
            [6,"Karnali"],
            [7,"Sudurpashchim"],
        ];
        foreach ($data as $datum)
        {
            $province = new Province();
            $province->name = $datum[1];
            $province->code = $datum[0];
            $province->save();
        }
    }
}

<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Gram','gm'],
            ['Kilogram','Kg'],
            ['Metre','m'],
            ['Pound','lbs'],
            ['Feet','ft']
        ];
        foreach ($data as $datum)
        {
            $unit = new Unit();
            $unit->name = $datum[0];
            $unit->symbol = $datum[1];
            $unit->save();
        }
    }
}

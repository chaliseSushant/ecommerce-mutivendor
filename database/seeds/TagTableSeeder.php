<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 10; $x++) {
            $category = new Tag();
            $category->keyword = 'tag' . $x;
            $category->save();
        }
        for ($x = 11; $x <= 15; $x++) {
            $category = new Tag();
            $category->keyword = 'tag' . $x;
            $category->save();
        }
    }
}

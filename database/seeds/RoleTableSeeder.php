<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['admin', 'Administrator', 1],
            ['vendor', 'Vendor', 2],
            ['employee', 'Employee', 3],
            ['customer', 'Customer', 4]
        ];
        foreach ($data as $datum) {
            $role = new Role();
            $role->role = $datum[0];
            $role->name = $datum[1];
            $role->order = $datum[2];
            $role->save();
        }
    }
}

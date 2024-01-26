<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['JackNDeals Admin','administrator@jackndeals.com','cr@ckth3d3@l@123'],
            /*['Vendor','vendor_admin@multivendor.com','secret'],*/
            ['JackNDeals Manager','manage@jackndeals.com','m@n@g3th3d3@l@123'],
            /*['Customer Account','customer@multivendor.com','secret'],
            ['Customer Account 2','customer2@multivendor.com','secret']*/
        ];
        foreach ($data as $datum)
        {
            $user = new User();
            $user->name = $datum[0];
            $user->email = $datum[1];
            $user->password = Hash::make($datum[2]);
            $user->save();
        }
        $ruds = [
            ['admin','administrator@jackndeals.com'],
            /*['vendor','vendor_admin@multivendor.com'],*/
            ['employee','manage@jackndeals.com'],
            /*['customer','customer@multivendor.com'],
            ['customer','customer2@multivendor.com'],*/
        ];
        foreach ($ruds as $rud)
        {
            $roles = new Role();
            $role = $roles->where('role',$rud[0])->first();
            $users = new User();
            $user = $users->where('email',$rud[1])->first();
            $user->role()->associate($role);
            $user->save();
        }
    }
}

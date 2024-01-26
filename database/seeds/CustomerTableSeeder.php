<?php

use App\Customer;
use App\CustomerAddress;
use App\District;
use App\User;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $customer->gender = 1;
        $customer->phone = '888888888';
        $customer->user()->associate(User::where('name','Customer Account')->first());
        $customer->save();

        $customer = new Customer();
        $customer->gender = 1;
        $customer->phone = '888888888';
        $customer->user()->associate(User::where('name','Customer Account 2')->first());
        $customer->save();

        $cust_addr = new CustomerAddress();
        $cust_addr->name = 'Something Something';
        $cust_addr->phone = '9849591415';
        $cust_addr->address_01 = 'Somewhere in the world';
        $cust_addr->address_02 = 'Under the sky, over the ground';
        $cust_addr->default = 1;
        $cust_addr->district_id = District::where('name','Makwanpur')->first()->id;
        $cust_addr->customer()->associate(User::where('name','Customer Account')->first()->customer);
        $cust_addr->save();

        $cust_addr = new CustomerAddress();
        $cust_addr->name = 'Nothing Nothing';
        $cust_addr->phone = '9802123454';
        $cust_addr->address_01 = 'Somewhere in the Universe';
        $cust_addr->address_02 = 'Near Andromeda, in Milkyway';
        $cust_addr->default = 0;
        $cust_addr->district_id = District::where('name','Kathmandu')->first()->id;
        $cust_addr->customer()->associate(User::where('name','Customer Account')->first()->customer);
        $cust_addr->save();

    }
}

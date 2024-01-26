<?php

use App\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Pending','Order process is not complete.'],
            ['Processing Payment','Payment has not been verified and is awaiting verification at store.'],
            ['Partially Paid','Full payment has not been done. Please complete payment for purchase or contact store.'],
            ['Payment Verified','Payment has been verified and is awaiting order processing.'],
            ['Processing Order','Order is being processed at store.'],
            ['Pending Delivery','Order has been processed and is pending delivery.'],
            ['On Delivery','Order is on the way for delivery.'],
            ['Delivered','Order has been delivered.'],
            ['Cancelled','Order has been cancelled by customer.'],
            ['Declined','Due to payment related or some other issues, order has been declined by store.'],
        ];

        foreach ($data as $datum) {
            $order_status = new OrderStatus();
            $order_status->name = $datum[0];
            $order_status->description = $datum[1];
            $order_status->save();
        }
    }
}

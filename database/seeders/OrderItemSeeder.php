<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_items = array(
            [
                'product_id' => '4',
                'order_id' => '1',
                'unitprice' => '500',
                'quantity' => '2',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'product_id' => '3',
                'order_id' => '2',
                'unitprice' => '300',
                'quantity' => '1',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'product_id' => '2',
                'order_id' => '2',
                'unitprice' => '300',
                'quantity' => '1',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
        );

        DB::table('order_items')->insert($order_items);
    }
}

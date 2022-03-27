<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = array(
            [
                'orderdate' => new DateTime("5-7-2020"),
                'ordernumber' => '5',
                'customer_id' => '2',
                'totalamount' => '1000',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'orderdate' => new DateTime("14-8-2020"),
                'ordernumber' => '8',
                'customer_id' => '2',
                'totalamount' => '600',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],


        );

        DB::table('orders')->insert($orders);
    }
}

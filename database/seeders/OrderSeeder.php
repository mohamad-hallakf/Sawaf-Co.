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
        $date1 = new DateTime("5-7-2020");
        $date2 = new DateTime("14-8-2020");
        $orders = array(
            [
                'orderdate' => $date1->format('Y-m-d'),
                'ordernumber' => '5',
                'customer_id' => '2',
                'totalamount' => '1000',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'orderdate' => $date2->format('Y-m-d'),
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

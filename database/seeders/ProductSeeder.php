<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            [
                'productname' => 'Chai',
                'supplier_id' => '1',
                'unitprice' => '150',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'productname' => 'Rice',
                'supplier_id' => '1',
                'unitprice' => '300',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'productname' => 'Sugar',
                'supplier_id' => '2',
                'unitprice' => '250',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'productname' => 'Biscuit',
                'supplier_id' => '3',
                'unitprice' => '500',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],

        );

        DB::table('products')->insert($products);
    }
}

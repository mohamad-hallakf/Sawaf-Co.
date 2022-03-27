<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers=array(
            [
                'firstname' => 'Mohamad',
                'lastname' => 'Zid',
                'city' => 'Beirut',
                'country' => 'Lebanon',
                'phone' => '02015485546',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'firstname' => 'Samer',
                'lastname' => 'Salam',
                'city' => 'Damascus',
                'country' => 'Syria',
                'phone' => '555456687',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
    );

        DB::table('customers')->insert($customers);    }
}

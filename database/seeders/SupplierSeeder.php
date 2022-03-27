<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = array(
            [
                'companyname' => 'SwafTech',
                'contactname' => 'Ahmad',
                'city' => 'Damascus',
                'country' => 'Syria',
                'phone' => '33324587',
                'fax' => '33324588',
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'companyname' => 'Durra',
                'contactname' => 'سعيد',
                'city' => 'دمشق',
                'country' => 'سوريا',
                'phone' => '555456687',
                'fax' => null,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'companyname' => 'كهربائيات المصري',
                'contactname' => 'محمود',
                'city' => 'حلب',
                'country' => 'سوريا',
                'phone' => null,
                'fax' => null,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
        );

        DB::table('suppliers')->insert($suppliers);
    }
}

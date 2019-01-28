<?php

use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\datum::truncate();
        foreach (range(1, 20) as $number) {
        	# code...
        	\App\datum::create([
        		'Voucher_number' => '憑單編號',
        		//'id' => $number,
        		'name' => '財產名稱',
        		'unit' => '單位',
        		'unit_price' => $number,
        		'purchase_date' => 990604,
        		'quantity' => $number,
        		'price' => $number,
        		'assignee' => '保管者',
        		'place' => '房間',
        		'confirmed' => 1,
        	]);
        }
    }
}

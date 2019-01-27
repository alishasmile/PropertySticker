<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            
            $table->increments('id');
            $table->text('Voucher_number');//憑單編號
            $table->text('property_id');//財產編號
            $table->text('name');//財產名稱
            $table->text('unit');//單位
            $table->integer('unit_price');//單價
            $table->text('purchase_date');//購買日期
            $table->integer('quantity');//數量
            $table->integer('price');//總價
            $table->text('assignee');//保管者
            $table->text('place');//房間
            $table->boolean('comfirmed');//是否貼過財產貼
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('oblast');
            $table->string('city');
            $table->string('postcode');
            $table->string('street');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('comment')->nullable();
            $table->enum('pay', ['cash_delivery', 'online_card'])->default('cash_delivery');
            $table->string('total');
            $table->longText('products');
            $table->string('promocode')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

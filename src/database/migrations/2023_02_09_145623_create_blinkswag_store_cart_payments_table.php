<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlinkswagStoreCartPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blinkswag_store_cart_payments', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->bigInteger('id_company');
            $table->longText('cart_item_json');
            $table->longText('product_for_shirt');
            $table->bigInteger('address_id');
            $table->longText('delivery_date');
            $table->integer('shipment_cost');
            $table->bigInteger('salesorder_id');
            $table->longText('stripe_payment_json');
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
        Schema::dropIfExists('blinkswag_store_cart_payments');
    }
}

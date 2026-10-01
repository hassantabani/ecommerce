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
            $table->string('customer_fname')->nullable();
            $table->string('customer_lname')->nullable();
            $table->string('customer_number')->nullable();
            $table->longText('customer_address1')->nullable();
            $table->longText('customer_address2')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_province')->nullable();
            $table->string('customer_country')->nullable();
            $table->longText('extra_customer_details')->nullable();
            $table->string('shipping_gateway')->nullable();
            $table->string('payment_method')->nullable();
            $table->longText('extra_shipping_details')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('total_price')->nullable();
            $table->string('total_items')->nullable();
            $table->string('qrcode_id')->nullable();
            $table->json('cart_items')->nullable();
            $table->string('user_profit')->nullable();
            $table->string('admin_cost')->nullable();
            $table->string('status')->nullable();
            $table->string('user_id')->nullable();
            $table->string('total_purchase')->nullable();
            $table->string('order_tracking')->nullable();
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

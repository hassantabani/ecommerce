<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->json('points');
            $table->string('stock');
            $table->string('price');
            $table->string('purchase_price');
            $table->string('discount');
            $table->string('is_sale');
            $table->enum('status',['1','0']);
            $table->enum('attribute',['1','0']);
            $table->string('category');
            $table->string('main_image');
            $table->json('more_media');
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
        Schema::dropIfExists('products');
    }
}

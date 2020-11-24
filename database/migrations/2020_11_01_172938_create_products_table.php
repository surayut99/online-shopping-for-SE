<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('store_id');
            $table->id('product_id');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('product_img_path')->default('storage/pictures/ecommerce.png');
            $table->string('product_primary_type');
            $table->string('product_secondary_type');
            $table->string('color');
            $table->string('size');
            $table->bigInteger('qty');
            $table->double('price');
            $table->boolean('recommended')->default(false);
            $table->timestamps();

            $table->foreign('store_id')->references('store_id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('products');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

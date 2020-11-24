<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->id('store_id');
            $table->string('store_name');
            $table->string('store_description');
            $table->string('store_tel')->default(' ');
            $table->string('store_bank')->default(' ');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('stores');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

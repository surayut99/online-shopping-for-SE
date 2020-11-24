<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->integer('no')->nullable(false);
            $table->string('receiver')->nullable(false);
            $table->string('telephone')->nullable(false);
            $table->string('address');
            $table->boolean('default')->default(false);
            $table->timestamps();

            $table->primary(array('user_id', 'no'));
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
        Schema::dropIfExists('addresses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

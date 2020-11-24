<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
//            $table->dropColumn(['purchased_at', 'verified_at', 'deliveried_at', 'completed_at', 'cancelled_at', 'payment_type']);
            $table->dropColumn(['purchased_at', 'verified_at', 'deliveried_at', 'completed_at', 'cancelled_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('purchased_at')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->dateTime('deliveried_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
//            $table->enum('payment_type', array('COD', 'Transfering'));
        });
    }
}

<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('store_id');

            $table->dateTime('ordered_at')->nullable(false);
            $table->dateTime('expired_at')->nullable(false);
            $table->dateTime('purchased_at')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->dateTime('deliveried_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            $table->double('total_cost')->nullable(false);
            $table->string('recv_address')->nullable(false);
            $table->string('recv_name')->nullable(false);
            $table->string('recv_tel')->nullable(false);
            $table->enum('status', array('purchasing', 'verifying', 'verified', 'deliveried', 'completed', 'cancelled'))->default('purchasing');
            $table->enum('shipment_type', array('Kerry', 'EMS', 'DHL', 'Flash', 'Standard Express'))->nullable(false);
            $table->enum('payment_type', array('COD', 'Transfering'));
            $table->string('track_id')->nullable();
            $table->string('store_comment')->nullable();

            $table->foreign('store_id')->references('store_id')->on('stores');
            $table->foreign('user_id')->references('id')->on('users');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}

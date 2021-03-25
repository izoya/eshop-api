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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('phone');
            $table->string('email', 120);
            $table->text('shipment_info');
            $table->decimal('amount', 8, 2, true);
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table)
        {
            $table->dropForeign(['user_id']);
            $table->dropIfExists();
        });
    }
}

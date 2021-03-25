<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity')->default(1);

            $table->primary(['order_id', 'product_id']);

            $table->foreign('order_id')->on('orders')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('product_id')->on('products')->references('id')
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
        Schema::table('orders_products', function (Blueprint $table)
        {
            $table->dropForeign(['order_id', 'product_id']);
            $table->dropIfExists();
        });
    }
}

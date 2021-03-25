<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->string('value', 10);

            $table->primary(['product_id', 'attribute_id']);

            $table->foreign('attribute_id')->on('attributes')->references('id')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('product_id')->on('products')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes_products', function (Blueprint $table) {
            $table->dropForeign(['attribute_id', 'product_id']);
            $table->dropIfExists();
        });
    }
}

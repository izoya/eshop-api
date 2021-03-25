<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_tree', function (Blueprint $table) {
            $table->unsignedBigInteger('ancestor_id');
            $table->unsignedBigInteger('descendant_id');

            $table->primary(['ancestor_id', 'descendant_id']);

            $table->foreign('ancestor_id')->on('categories')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('descendant_id')->on('categories')->references('id')
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
        Schema::table('categories_tree', function (Blueprint $table) {
            $table->dropForeign(['ancestor_id', 'descendant_id']);
            $table->dropIfExists();
        });
    }
}

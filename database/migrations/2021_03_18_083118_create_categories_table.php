<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level');
            $table->string('sort_id', 10);

            $table->foreign('parent_id')->on('categories')->references('id')
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIfExists();
        });
    }
}

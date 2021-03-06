<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('writer');
            $table->text('description');
            $table->float('price')->unsigned()->ceil();
            $table->float('current_price')->unsigned()->nullable()->ceil();
            $table->boolean('availability')->unsigned();
            $table->float('discount')->unsigned()->nullable();
            $table->string('genre_name');
            $table->string('image');

            $table->foreign('genre_name')->references('name')->on('genres')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}

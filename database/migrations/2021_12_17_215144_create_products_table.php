<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->integer('price');
            $table->string('amount')->default(1);
            $table->date('ex_date');
            $table->string('photo');
            $table->string('pro_phone_number');
            $table->string('description')->nullable();
            $table->Integer('show')->default(0);
            $table->timestamps();
            $table->bigInteger('us_id')->unsigned();
            //    $table->bigInteger('br_id')->unsigned();
            $table->foreign('us_id')->references('id')->on('users')->onDelete('cascade');
            //  $table->foreign('br_id')->references('id')->on('brands')->onDelete('cascade');
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
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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('role_id');
            $table->string('name',100);
            $table->string('brand',100);
            $table->integer('quantity');
            $table->string('size');
            $table->string('color');
            $table->boolean('stock')->default(1);
            $table->decimal('purchase',8,2);
            $table->decimal('sale',8,2);
            $table->decimal('promo',8,2)->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('status')->default('0');
            $table->boolean('hide')->default('1');
            $table->text('description')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->foreign('role_id')->references('id')->on('roles');
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

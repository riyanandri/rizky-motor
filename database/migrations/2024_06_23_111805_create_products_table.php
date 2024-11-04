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
            $table->unsignedBigInteger('merk_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('unit');
            $table->integer('qty');
            $table->integer('price');
            $table->enum('condition', ['baru', 'bekas']);
            $table->text('description')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('merk_id')->references('id')->on('merks');
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

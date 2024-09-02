<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
    //     Schema::create('products', function (Blueprint $table) {
    //         $table->id(); // This creates an unsigned big integer column
    //         $table->string('name');
    //         $table->unsignedBigInteger('shop_id'); // This must match the type in `shops` table
    //         $table->unsignedBigInteger('category_id'); // This must match the type in `categories` table
    //         $table->text('description')->nullable();
    //         $table->decimal('price', 10, 2);
    //         $table->integer('stock_quantity');
    //         $table->timestamps();

    //         $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
    //         $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    //     });
    // }

    // public function down()
    // {
    //     Schema::dropIfExists('products');
    // 
    }
}

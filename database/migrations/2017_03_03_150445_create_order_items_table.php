<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_items', function (Blueprint $table) {
      $table->integer('order_id')->unsigned();
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

      $table->integer('product_id')->unsigned();
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

      $table->integer('quantity');
      $table->float('unitPrice');

      $table->primary(['order_id', 'product_id']);

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
    Schema::dropIfExists('order_items');
  }
}
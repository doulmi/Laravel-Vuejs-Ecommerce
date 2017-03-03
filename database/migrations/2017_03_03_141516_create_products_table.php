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

      $table->string('name_fr');
      $table->string('name_en');

      $table->boolean('active')->default(true);
      $table->string('slug')->unique()->index();
      $table->float('price');
      $table->float('sale_price');
      $table->boolean('on_sale');
      $table->integer('stock');

      $table->text('description');  //markdown

      $table->integer('view');
      $table->integer('lastMonthView');

      $table->integer('category_id')->unsigned();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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

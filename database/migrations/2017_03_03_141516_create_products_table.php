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

      $table->text('description');  //markdown

      $table->string('images')->nullabel(); //split by ||
      $table->string('avatar'); //main avatar

      $table->integer('category_id')->unsigned();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

      $table->boolean('active')->default(true);
      $table->string('slug')->unique()->index();
      $table->float('price');
      $table->integer('stock');

      $table->boolean('on_sale');
      $table->float('sale_price')->nullable();

      $table->integer('view');
      $table->integer('lastMonthView');

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

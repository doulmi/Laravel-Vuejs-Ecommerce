<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('promo_codes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('code')->unique();
      $table->integer('count');
      $table->float('reduction');
      $table->timestamp('expiration');
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
    Schema::dropIfExists('promo_codes');
  }
}

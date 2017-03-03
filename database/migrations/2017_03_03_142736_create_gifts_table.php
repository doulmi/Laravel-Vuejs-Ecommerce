<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('gifts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_fr');
      $table->string('name_en');
      $table->boolean('active')->default(true);
      $table->string('slug')->unique()->index();
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
    Schema::dropIfExists('gifts');
  }
}

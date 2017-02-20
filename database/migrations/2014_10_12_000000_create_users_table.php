<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('addresse1');
      $table->string('addresse2');
      $table->integer('language_id')->unsigned();
      $table->integer('currency_id')->unsigned();
      
      $table->softDeletes();
      $table->rememberToken();
      $table->timestamps();

      //foreign keys
      $table->integer('language_id')->unsigned();
      $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');;
      
      $table->integer('currency_id')->unsigned();
      $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');;
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('users');
  }
}

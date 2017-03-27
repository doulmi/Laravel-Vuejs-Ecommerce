<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->string('address');
      $table->string('state');      //0: 待提交, 1: 提交订单, 2: 商品出库, 3: 等待收货，4: 完成, 5: 待退款, 6: 已退货
      $table->string('pay_state');  //0: 代付款, 2: 已付款, 3: 代退款， 4: 退款成功，5：退款失败

      $table->float('price');
      $table->float('delivery_price');
      $table->float('promo_code');
      $table->float('total_price');
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
    Schema::dropIfExists('orders');
  }
}

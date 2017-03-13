<?php

namespace App\Http\Controllers;

use App\Payments\PaymentStrategy;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  private $strategy;

  public function __construct(PaymentStrategy $strategy)
  {
    $this->strategy = $strategy;
  }

  public function pay(Request $request) {
    $this->strategy->charge($request->all());
  }
}

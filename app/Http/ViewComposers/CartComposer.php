<?php

namespace App\Http\ViewComposers;

use App\Http\Controllers\API\CartController;
use Auth;
use Cookie;
use Illuminate\View\View;

class CartComposer
{
  private $cartController;

  public function __construct(CartController $cartController) {
    $this->cartController = $cartController;
  }

  public function compose(View $view)
  {
    if(Auth::check()) {
      $cart = $this->cartController->count(Auth::id());
      $view->with('cart', $cart);
    }
  }
}
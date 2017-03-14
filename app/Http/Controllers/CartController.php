<?php

namespace App\Http\Controllers;

use App\Cart;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index() {
    $records = Cart::with('product')->where('user_id', Auth::id())->get();
    return view('cart', compact('records'));
  }
}


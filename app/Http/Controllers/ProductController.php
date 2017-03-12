<?php

namespace App\Http\Controllers;

use App;
use App\Product;
use App\ProductRelative;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $product = Product::where('slug', $slug)->first();

    if ($product) {
      $relativeProducts = ProductRelative::with('relativeProduct')->where('product_id', $product->id)->get();

      if (App::getLocale() == 'fr') {
        $product->name = $product->name_fr;
      } else {
        $product->name = $product->name_en;
      }

      //get first 5 buyers of this products
      $buyers = $product->buyers()->orderBy('orders.id')->limit(5)->get(['users.id', 'users.avatar']);
      if (Auth::check()) {
        $product->like = App\Like::where('user_id', Auth::id())->where('product_id', $product->id)->first() ? 1 : 0;
      } else {
        $product->like = 0;
      }

      return view('products.show', compact('product', 'relativeProducts', 'buyers'));
    }
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}

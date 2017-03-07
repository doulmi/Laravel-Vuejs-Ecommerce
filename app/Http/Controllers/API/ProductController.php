<?php

namespace App\Http\Controllers\API;

use App;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ProductController extends Controller
{
  public function index(Request $request, $order, $limit, $page)
  {
    $query = Product::query();

    /** order */
    //random by default
    if ($order == 'latest') { //latest
      $query->latest();
    } else if ($order == 'popular') {
      //TODO : order by commands number
    } else if ($order == 'expensive') { //most expensive
      $query->orderBy('price', 'DESC');
    } else if ($order == 'cheapest') { //cheapest
      $query->orderBy('price', 'ASC');
    } else {
      $query->inRandomOrder();
    }

    $products = $query
      ->paginate($limit, ['*'], 'page', $page);

    return $products;
  }

  public function show($slug)
  {

  }
}

<?php

namespace App\Http\Controllers\API;

use App;
use App\CollectProduct;
use App\Like;
use App\Comment;
use App\Product;
use App\ProductRelative;
use App\Repositories\ProductRepository;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{
  private $productRepo;

  public function __construct(ProductRepository $productRepo)
  {
    $this->productRepo = $productRepo;
  }

  public function index($order, $limit, $page)
  {
    $products = $this->productRepo->paginate($order, $limit, $page);

    return $products;
  }

  public function show($id)
  {
    $product = Product::findOrFail($id);

    if (App::getLocale() == 'fr') {
      $product->name = $product->name_fr;
    } else {
      $product->name = $product->name_en;
    }

    //get first 5 buyers of this products
    $product->users = $product->buyers()->orderBy('orders.id')->limit(5)->get(['users.id', 'users.avatar']);
    $product->relativeProduct = ProductRelative::with('relativeProduct')->where('product_id', $product->id)->get();

    return $product;
  }

  public function comment(Request $request)
  {
    $success = Comment::create([
      'user_id' => $request->get('userId'),
      'product_id' => $request->get('productId'),
      'content' => $request->get('content'),
    ]);
    if (!$success) {
      return response()->json(['error' => 'database_error'], 412);
    }
  }

  public function comments($productId, $limit, $page)
  {
    return Comment::with('user')->where('product_id', $productId)->paginate($limit, ['*'], 'page', $page);
  }
}

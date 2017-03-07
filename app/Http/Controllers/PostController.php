<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index() {
    $url = 'products/explore/';
    return view('index', compact('url'));
  }

  public function latest() {
    $url = 'products/latest/';
    return view('index', compact('url'));
  }

  public function popular() {
    $url = 'products/popular/';
    return view('index', compact('url'));
  }
}

<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class OrderRepository
{
  private $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function create($userId)
  {

  }

  public function index($userId)
  {

  }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function dashboard()
  {
    $data['title'] = trans('backpack::base.dashboard');
    return view('backpack::dashboard', $data);
  }
}

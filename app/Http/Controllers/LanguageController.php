<?php

namespace App\Http\Controllers;

use Redirect;
use Session;

class LanguageController extends Controller
{
  public function switchLang($lang)
  {
    Session::set('applocale', $lang);
    return Redirect::back();
  }
}

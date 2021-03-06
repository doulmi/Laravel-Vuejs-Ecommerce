<?php
namespace App\Http\Controllers\Auth;

use App\Events\AfterLogin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Redirect;
use Session;

class LoginController extends Controller
{
  /*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest', ['except' => 'logout']);
    $prevUrl = Redirect::getUrlGenerator()->previous();
    if (!str_contains($prevUrl, ['login', 'register'])) {
      Session::set('prevUrl', $prevUrl);
    }
  }


  protected function authenticated(Request $request, $user)
  {
//    event(new AfterLogin);
    return redirect(Session::get('prevUrl', '/'));
  }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Events\AfterLogin;
use App\Helper;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use Session;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
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
    $this->middleware('guest');
    $prevUrl = Redirect::getUrlGenerator()->previous();
    if (!str_contains($prevUrl, ['login', 'register'])) {
      Session::set('prevUrl', $prevUrl);
    }
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6|confirmed',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array $data
   * @return User
   */
  public function create(array $data)
  {
    $email = $data['email'];
    $user = User::create([
      'name' => $this->autoName($email),
      'avatar' => $this->getGravatar($email, 128),
      'email' => $email,
      'confirmation_code' => str_random(64),
      'password' => bcrypt($data['password']),
      'marketingId' => Helper::getMarketId()
    ]);

    //getCookies
//    event(new AfterLogin($user));

    return $user;
  }

  private function getGravatar($email, $s = 80, $d = 'identicon', $r = 'g') {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower( trim( $email ) ));
    $url .= "?s=$s&d=$d&r=$r";
    return $url;
  }

  /**
   * Generate a defaut username by user's email
   * @param $email
   * @return mixed
   */
  private function autoName($email)
  {
    return title_case(preg_replace("/[_\.-]/", " ", explode('@', $email)[0]));
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  mixed $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    return redirect(Session::get('prevUrl', '/'));
  }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

  private function createOrGetUser(ProviderUser $providerUser, $provider)
  {
    $account = SocialAccount::whereProvider($provider)
      ->whereProviderUserId($providerUser->getId())
      ->first();

    if ($account) {
      return $account->user;
    } else {
      $account = new SocialAccount([
        'provider_user_id' => $providerUser->getId(),
        'provider' => $provider
      ]);

      $email = $providerUser->getEmail();
      if ($email) {

        $user = User::whereEmail($providerUser->getEmail())->first();
        if (!$user) {
          $user = User::create([
            'email' => $providerUser->getEmail(),
            'name' => $providerUser->getName(),
            'password' => bcrypt('123456')
          ]);
        }
      } else {
        $user = User::create([
          'name' => $providerUser->getName(),
          'password' => bcrypt('123456')
        ]);
      }

      $account->user()->associate($user);
      $account->save();
      return $user;
    }
  }

  //facebook
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function callback($provider)
  {
    $user = $this->createOrGetUser(Socialite::driver($provider)->user(), $provider);
    Auth::login($user);
    return redirect()->to('/home');
  }
}

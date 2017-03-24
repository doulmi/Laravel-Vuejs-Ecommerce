<?php

namespace App\Http\Controllers;

use App\Events\AfterLogin;
use App\Helper;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades\Socialite;
use Redirect;
use Session;

class SocialAuthController extends Controller
{
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

  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function callback($provider)
  {
    $user = $this->createOrGetUser(Socialite::driver($provider)->user(), $provider);
    Auth::login($user);
    return redirect(Session::get('prevUrl', '/'));
  }

  private function createOrGetUser(ProviderUser $providerUser, $provider)
  {
    $account = SocialAccount::whereProvider($provider)
      ->whereProviderUserId($providerUser->getId())
      ->first();

    if ($account) {
      $user = $account->user;
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
            'password' => str_random(6),
            'marketingId' => Helper::getMarketId()
          ]);
        }
      } else {
        $user = User::create([
          'name' => $providerUser->getName(),
          'password' => str_random(6),
          'marketingId' => Helper::getMarketId()
        ]);
      }

      $account->user()->associate($user);
      $account->save();
    }


//    event(new AfterLogin);
    return $user;
  }
}

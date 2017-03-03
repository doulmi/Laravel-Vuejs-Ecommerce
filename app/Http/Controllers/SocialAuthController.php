<?php

namespace App\Http\Controllers;

use App\SocialAccount;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
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
}

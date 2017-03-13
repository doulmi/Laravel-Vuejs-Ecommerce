<?php

namespace App\Payments;

use Cartalyst\Stripe\Stripe;

class StripePayment implements PaymentStrategy {
  private $stripe;

  public function __construct(Stripe $stripe)
  {
    $this->stripe = $stripe;
  }

  public function charge($creditInfo) {
    $charge = $this->stripe->charges()->create([
      'amount' => $creditInfo['amount'],
      'currency' => 'EUR',
      'source' => [
        'object'    => 'card',
        'name'      => $creditInfo['name'],
        'number'    => $creditInfo['card_no'],
        'cvc'       => $creditInfo['cvc'],
        'exp_month' => $creditInfo['expiration_month'],
        'exp_year'  => $creditInfo['expiration_year'],
      ]
    ]);
    dd($charge);
  }
}
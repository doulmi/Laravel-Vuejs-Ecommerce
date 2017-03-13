<?php

namespace App\Payments;

interface PaymentStrategy {
  public function charge($creditInfo);
}
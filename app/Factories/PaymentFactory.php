<?php

namespace App\Factories;

use App\Services\Payments\PayPalService;
use App\Services\Payments\StripeService;

class PaymentFactory
{
    public function make(string $gateway)
    {
        return match ($gateway) {
            'paypal' => new PayPalService(),
            'stripe' => new StripeService(),
            default => throw new \Exception("Gateway not supported"),
        };
    }
}

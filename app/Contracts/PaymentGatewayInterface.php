<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function pay(float $amount);
    public function success(Request $request);
    public function cancel();
}

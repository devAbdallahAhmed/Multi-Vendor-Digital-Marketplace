<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;

use App\Factories\PaymentFactory;

class PaymentController extends Controller
{
    public function pay(string $gateway, PaymentFactory $factory)
    {
        return $factory->make($gateway)->pay(getCartTotal());
    }

    public function success(string $gateway, Request $request, PaymentFactory $factory)
    {
        return $factory->make($gateway)->success($request);
    }
}

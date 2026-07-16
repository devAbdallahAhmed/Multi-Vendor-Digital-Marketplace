<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Factories\PaymentFactory;
use App\Traits\ApiResponseTrait;

class ApiPaymentController extends Controller

{
    use ApiResponseTrait;
    public function processPayment(string $gateway, PaymentFactory $factory)
    {
        try {
            if (!in_array($gateway, ['stripe', 'paypal'])) {
                return $this->errorResponse('Payment gateway not supported', 400);
            }

            $amount = getCartTotal();

            if ($amount <= 0) {
                return $this->errorResponse('Cart is empty or amount is invalid', 422);
            }

            $paymentUrl = $factory->make($gateway)->pay($amount);

            return $this->successResponse(
                ['payment_url' => $paymentUrl],
                'Payment initiated successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}

<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Services\OrderService;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class StripeService implements PaymentGatewayInterface
{
    public function pay(float $amount)
    {
        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $session = StripeSession::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => config('settings.default_currency'),
                    'product_data' => ['name' => 'Product Purchase'],
                    'unit_amount' => ($amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['gateway' => 'stripe']) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel', ['gateway' => 'stripe']),
        ]);

        $url = $session->url;

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'url' => $url
            ]);
        }

        return redirect()->away($url);
    }
    public function success(Request $request)
    {
        Stripe::setApiKey(config('settings.stripe_secret_key'));
        $session = StripeSession::retrieve($request->session_id);

        if ($session->payment_status === 'paid') {
            OrderService::storeOrder(
                $session->payment_intent,
                ($session->amount_total / 100),
                $session->currency,
                1,
                'stripe'
            );
            CartItem::where('user_id', Auth::id())->delete();
            return redirect()->route('home');
        }
        return redirect()->route('payment.cancel', ['gateway' => 'stripe']);
    }

    public function cancel()
    {
        return redirect()->route('checkout');
    }
}

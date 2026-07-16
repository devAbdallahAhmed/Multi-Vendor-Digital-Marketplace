<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Services\OrderService;
use App\Services\NotificationService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class PayPalService implements PaymentGatewayInterface
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient($this->getConfig());
        $this->provider->getAccessToken();
    }

    private function getConfig()
    {
        return [
            'mode'    => config('settings.paypal_mode', 'sandbox'),
            'sandbox' => [
                'client_id'     => config('settings.paypal_client_id', ''),
                'client_secret' => config('settings.paypal_secret_key', ''),
                'app_id'        => config('settings.paypal_app_id', ''),
            ],
            'live' => [
                'client_id'     => config('settings.paypal_client_id', ''),
                'client_secret' => config('settings.paypal_secret_key', ''),
                'app_id'        => config('settings.paypal_app_id', ''),
            ],
            'payment_action' => 'Sale',
            'currency'       => config('settings.default_currency', 'USD'),
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
    }
    public function pay(float $amount)
    {
        $response = $this->provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success', ['gateway' => 'paypal']),
                "cancel_url" => route('payment.cancel', ['gateway' => 'paypal']),
            ],
            "purchase_units" => [["amount" => ["currency_code" => config('settings.default_currency'), "value" => $amount]]]
        ]);

        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {

                    $url = $link['href'];

                    if (request()->expectsJson() || request()->is('api/*')) {
                        return response()->json([
                            'status' => 'success',
                            'url' => $url
                        ]);
                    }

                    return redirect()->away($url);
                }
            }
        }

        throw new \Exception('Something went wrong with PayPal processing.');
    }
    public function success(Request $request)
    {
        $response = $this->provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $captureData = $response['purchase_units'][0]['payments']['captures'][0];

            OrderService::storeOrder(
                $captureData['id'],
                $captureData['amount']['value'],
                $captureData['amount']['currency_code'],
                1,
                'paypal'
            );

            CartItem::where('user_id', Auth::id())->delete();
            return redirect()->route('payment.completed');
        }
        return redirect()->route('payment.paypal.cancel');
    }

    public function cancel()
    {
        return redirect()->route('checkout');
    }
}

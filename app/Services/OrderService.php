<?php

namespace App\Services;

use App\Models\AuthorSale;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    static function storeOrder($paymentId, $paidAmount, $currencyIcon, $exchangeRate, $paymentGateway = '')
    {
        return DB::transaction(function () use ($paymentId, $paidAmount, $currencyIcon, $exchangeRate, $paymentGateway) {

            $purchase = new Purchase();
            $purchase->user_id = Auth::id();
            $purchase->code = 'ORD-' . time() . '-' . rand(1000, 9999);
            $purchase->status = 'completed';
            $purchase->save();


            foreach (getCartItems() as $cartItem) {
                $purchaseItem = new PurchaseItem();
                $purchaseItem->purchase_id = $purchase->id;

                $purchaseItem->author_id = $cartItem->item->author_id;

                $purchaseItem->item_id = $cartItem->item->id;
                $purchaseItem->price = $cartItem->item->price;
                $purchaseItem->quantity = 1;
                $purchaseItem->total = $cartItem->item->price;
                $purchaseItem->save();
            }

            $transaction = new Transaction();
            $transaction->purchase_id = $purchase->id;
            $transaction->user_id = Auth::id();
            $transaction->payment_id = $paymentId;
            $transaction->payment_gateway = $paymentGateway;
            $transaction->paid_amount = $paidAmount;
            $transaction->paid_in_currency_icon = $currencyIcon;
            $transaction->exchange_rate = $exchangeRate;
            $transaction->status = 'completed';
            $transaction->save();

            // Author Commission
            foreach (getCartItems() as $cartItem) {
                $amount = $cartItem->item->discount_price > 0 ? $cartItem->item->discount_price : $cartItem->item->price;                $sales = new AuthorSale();
                $sales->author_id = $cartItem->item->author_id;
                $sales->user_id = Auth::user()->id;
                $sales->item_id = $cartItem->item->id;
                $sales->amount = $amount;
                $sales->author_commission_rate = config('settings.author_commission');
                $sales->author_earning = $amount *  (config('settings.author_commission') / 100);
                $sales->save();
                }


            return $purchase;
        });
    }
}

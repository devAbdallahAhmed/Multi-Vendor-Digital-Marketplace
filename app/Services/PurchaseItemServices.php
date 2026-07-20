<?php

namespace  App\Services;

use App\Models\Category;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\AuthorSale;

class PurchaseItemServices
{

    function getALLPurchase()
    {
        $categories = Category::with('subCategories')->get();
        $orders = PurchaseItem::with('item')->where('user_id', Auth::user()->id)->paginate(25);

        return [
            'categories' => $categories,
            'orders' => $orders
        ];
    }

    function ShowSingleOrder($id)
    {
        return PurchaseItem::findOrFail($id);
    }

    function transaction()
    {
        return  Transaction::where('user_id', Auth::user()->id)->latest()->paginate(20);
    }

    function salesService()
    {
        return  AuthorSale::with('item')->where('author_id', Auth::id())->latest()->paginate(20);
    }
}

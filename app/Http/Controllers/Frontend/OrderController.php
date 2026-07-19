<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AuthorSale;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategories')->get();
        $orders = PurchaseItem::with('item')->where('user_id', Auth::user()->id)->paginate(25);
        return view('frontend.dashboard.order.index', compact('orders', 'categories'));
    }

    public function  show(int $id)
    {
        $order = PurchaseItem::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }

    public function transaction()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->latest()->paginate(20);
        return view('frontend.dashboard.order.transaction', compact('transactions'));
    }

    public function sales()
    {
        $sales = AuthorSale::with('item')->where('author_id', Auth::id())->latest()->paginate(20);
        return view('frontend.dashboard.order.sells', compact('sales'));
    }
}

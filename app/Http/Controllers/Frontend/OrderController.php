<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AuthorSale;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use App\Services\PurchaseItemServices;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $purchaseItemServices;

    public function __construct(PurchaseItemServices $purchaseItemServices)
    {
        $this->purchaseItemServices = $purchaseItemServices;
    }
    public function index()
    {
        $data =   $this->purchaseItemServices->getALLPurchase();
        return view('frontend.dashboard.order.index', $data);
    }

    public function  show(int $id)
    {
        $order = $this->purchaseItemServices->ShowSingleOrder($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }

    public function transaction()
    {
        $transactions = $this->purchaseItemServices->transaction();
        return view('frontend.dashboard.order.transaction', compact('transactions'));
    }

    public function sales()
    {
        $sales = $this->purchaseItemServices->salesService();
        return view('frontend.dashboard.order.salas', compact('sales'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Purchase::with('user:id,name', 'transaction')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $id)
    {
        $order = Purchase::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}

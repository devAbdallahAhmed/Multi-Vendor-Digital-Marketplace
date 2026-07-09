<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItem = $this->cartService->getCart(Auth::user()->id);

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'data' => $cartItem
            ], 200);
        }

        return view('frontend.pages.cart', compact('cartItem'));
    }

    public function store(int $id, Request $request): JsonResponse
    {
        $user = auth()->id();
        $result = $this->cartService->addToCart($id, $user);

        if (!$result['success']) {
            return response()->json([
                'status' => $result['status'],
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'cart_count' => $result['cart_count']
        ], $result['code']);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = Auth::user()->id;
        $result = $this->cartService->removeFromCart($id, $user);

        if (!$result['success']) {
            return response()->json([
                'status' => $result['status'],
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json([
            'status' => 'success',
            'message' => $result['message']
        ], $result['code']);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartItemResource;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCartItemController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): JsonResponse
    {
        $cartItem = $this->cartService->getCart(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => CartItemResource::collection($cartItem)
        ], 200);
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

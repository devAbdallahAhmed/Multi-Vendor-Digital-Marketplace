<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Validation\ValidationException;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCart(int $userId)
    {
        return $this->cartRepository->getCartItems($userId);
    }

    public function addToCart(int $itemId, int $userId): array
    {
        if (!$this->cartRepository->checkItemActive($itemId)) {
            throw ValidationException::withMessages(['error' => __('Item Not Found or Not Approved')]);
        }

        if ($this->cartRepository->checkItemInCart($itemId, $userId)) {
            return [
                'success' => false,
                'status' => 'error',
                'message' => __('Item already Exists'),
                'code' => 400
            ];
        }

        $this->cartRepository->createCartItem($userId, $itemId);
        $cart_count = $this->cartRepository->getCartCount($userId);

        return [
            'success' => true,
            'cart_count' => $cart_count,
            'message' => __('item added to cart'),
            'code' => 200
        ];
    }

    public function removeFromCart(int $id, int $userId): array
    {
        $cartItem = $this->cartRepository->findCartItem($id, $userId);

        if (!$cartItem) {
            return [
                'success' => false,
                'status' => 'error',
                'message' => __('Item not found in cart'),
                'code' => 400
            ];
        }

        $cartItem->delete();
        return [
            'success' => true,
            'message' => __('Item Removed From Cart'),
            'code' => 200
        ];
    }
}

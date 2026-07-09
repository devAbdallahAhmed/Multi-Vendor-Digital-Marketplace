<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Models\Item;

class CartRepository
{
    public function getCartItems(int $userId)
    {
        return CartItem::where('user_id', $userId)
            ->with(['item.category'])
            ->get();
    }

    public function checkItemActive(int $itemId): bool
    {
        return Item::where('id', $itemId)->where('status', 'active')->exists();
    }

    public function checkItemInCart(int $itemId, int $userId): bool
    {
        return CartItem::where('item_id', $itemId)->where('user_id', $userId)->exists();
    }

    public function findCartItem(int $id, int $userId)
    {
        return CartItem::where('id', $id)->where('user_id', $userId)->first();
    }

    public function createCartItem(int $userId, int $itemId): CartItem
    {
        $cart = new CartItem();
        $cart->user_id = $userId;
        $cart->item_id = $itemId;
        $cart->save();

        return $cart;
    }

    public function getCartCount(int $userId): int
    {
        return CartItem::where('user_id', $userId)->count();
    }
}

<?php

use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

function kycCount()
{
    return \App\Models\KycVerification::where('status', 'pending')->count();
}


if (!function_exists('hasPermission')) {
    function hasPermission($permissions)
    {
        $user = auth()->guard('admin')->user();

        if (!$user) {
            return false;
        }

        $hasPermission = $user->hasAnyPermission($permissions);
        $isSuperAdmin = $user->hasRole('super admin');

        if ($hasPermission || $isSuperAdmin) {
            return true;
        }

        return false;
    }
}


if (!function_exists('format_size')) {
    function format_size($bytes, $decimalPlaces = 1)
    {
        if ($bytes < 0) {
            return 0;
        }

        $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $factor = floor((strlen($bytes) - 1) / 3);

        $formattedSize = $bytes / pow(1024, $factor);

        return round($formattedSize, $decimalPlaces) . ' ' . $sizes[$factor];
    }
}


if (!function_exists('getIcon')) {
    function getIcon($mimeType)
    {
        $fileIcon = 'bi-file-earmark';

        if (str_starts_with($mimeType, 'image/')) {
            $fileIcon = "bi-file-earmark-image";
        } elseif (str_starts_with($mimeType, 'video/')) {
            $fileIcon = "bi-file-earmark-play";
        } elseif (str_starts_with($mimeType, 'audio/')) {
            $fileIcon = "bi-file-earmark-music";
        } elseif (str_starts_with($mimeType, 'pdf/')) {
            $fileIcon = "bi-file-earmark-pdf";
        } elseif (str_starts_with($mimeType, 'text/')) {
            $fileIcon = "bi-file-earmark-text";
        } elseif (str_starts_with($mimeType, 'application/')) {
            $fileIcon = "bi-file-earmark-zip";
        }

        return $fileIcon;
    }
}


if (!function_exists('statusCount')) {
    function statusCount()
    {
        return Item::with('author')->where('status', 'active')->count();
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return $date ? $date->format('Y-m-d') : 'N/A';
    }
}


if (!function_exists('getFileSize')) {
    function getFileSize($path)
    {
        $cleanPath = ltrim($path, '/');

        $privatePath = storage_path('app/private/' . $cleanPath);
        if (\Illuminate\Support\Facades\File::exists($privatePath)) {
            return formatBytes(\Illuminate\Support\Facades\File::size($privatePath));
        }

        $publicPath = public_path($cleanPath);
        if (\Illuminate\Support\Facades\File::exists($publicPath)) {
            return formatBytes(\Illuminate\Support\Facades\File::size($publicPath));
        }

        return 'N/A';
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}


if (!function_exists('getCartCount')) {
    function getCartCount(): int
    {
        return CartItem::where('user_id', Auth::user()->id)->count();
    }
}

if (!function_exists('getCartItems')) {
    function getCartItems()
    {
        return CartItem::where('user_id', Auth::user()->id)->with('item')->get();
    }
}


if (!function_exists('getCartTotal')) {
    function getCartTotal(): float
    {
        $cartItems = CartItem::where('user_id', Auth::user()->id)->with('item')->get();
        $total = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->item->discount_price > 0) {
                $total += $cartItem->item->discount_price;
            } else {
                $total += $cartItem->item->price;
            }
        }

        return (float) $total;
    }
}

function currencyPosition($amount = 0)
{
    return config('settings.currency_position') == 'left' ? config('settings.currency_icon') . $amount : $amount . config('settings.currency_icon');
}

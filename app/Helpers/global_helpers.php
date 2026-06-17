<?php
function kycCount()
{
    return \App\Models\KycVerification::where('status', 'pending')->count();
}


if (!function_exists('hasPermission')) {
    function  hasPermission($permissions)
    {
        $user = auth()->guard('admin')->user();

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

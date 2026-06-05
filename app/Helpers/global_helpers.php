<?php
function kycCount() {
    return \App\Models\KycVerification::where('status', 'pending')->count();
}


if(!function_exists('hasPermission')){
    function  hasPermission( $permissions){
        $user = auth()->guard('admin')->user();

        $hasPermission = $user->hasAnyPermission($permissions);

        $isSuperAdmin = $user->hasRole('super admin');

        if ($hasPermission || $isSuperAdmin) {
            return true;
        }

        return false;    }
}

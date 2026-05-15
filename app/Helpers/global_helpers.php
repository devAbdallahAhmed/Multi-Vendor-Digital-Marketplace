<?php
function kycCount() {
    return \App\Models\KycVerification::where('status', 'pending')->count();
}


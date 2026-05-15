<?php

namespace App\Services;

use App\Models\KycVerification;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Auth;

class KycService
{
    use FileUpload;


    public function handleVerification(array $data, array $files): KycVerification
    {
        $paths = $this->uploadDocuments($files);

        return KycVerification::create([
            'user_id'         => Auth::id(),
            'document_type'   => $data['document_type'],
            'document_number' => $data['document_number'],
            'documents'       => ($paths),
        ]);
    }

    private function uploadDocuments(array $files): array
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->uploadFile($file, 'kyc_documents', disk:'local');
        }
        return $paths;
    }
}

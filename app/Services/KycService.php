<?php

namespace App\Services;

use App\Models\KycVerification;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class KycService
{
    use FileUpload;

    public function handleVerification(array $data, array $files): KycVerification
    {
        return DB::transaction(function () use ($data, $files) {

            $paths = $this->uploadDocuments($files);

            if (empty($paths)) {
                throw new Exception(__('Failed to upload documents. Please try again.'));
            }

            return KycVerification::create([
                'user_id' => Auth::id(),
                'document_type' => $data['document_type'],
                'document_number' => $data['document_number'],
                'documents' => $paths,
            ]);
        });
    }

    private function uploadDocuments(array $files): array
    {
        $paths = [];
        foreach ($files as $file) {
            $path = $this->uploadFile($file, 'kyc_documents', disk: 'local');

            if (!$path) {
                throw new Exception(__('One of the documents failed to upload.'));
            }

            $paths[] = $path;
        }
        return $paths;
    }



    public function handelResubmitKyc(KycVerification $kyc, array $data, array $files)
    {
        return DB::transaction(function () use ($kyc, $data, $files) {

            if (is_array($kyc->documents)) {
                foreach ($kyc->documents as $oldPath) {
                    $this->deleteFile($oldPath, 'local');
                }

                $paths = $this->uploadDocuments($files);
            }
            if (empty($paths)) {
                throw new Exception(__('Failed to upload new documents.'));
            }

            $kyc->update([
                'document_type'   => $data['document_type'],
                'document_number' => $data['document_number'],
                'documents'       => $paths,
                'status'          => 'pending',
                'reject_reason'   => null      
            ]);

            return $kyc;
        });
    }
}

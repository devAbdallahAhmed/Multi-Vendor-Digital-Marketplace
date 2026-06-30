<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\PasswordRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Api\AdminResource;
use App\Http\Requests\Api\Admin\ProfileRequest;
use App\Traits\fileUpload;
use App\Services\Admin\ProfileService;
class ProfileController extends Controller
{

    use fileUpload;
/**
     * Display a listing of the resource.
     */
    protected $profileService;

    function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index()
    {
        $admin = auth('admin-api')->user();
        return response()->json([ 'success' => true, 'data' => new AdminResource($admin),]);
    }

    public function update(ProfileRequest $request)
    {
        $admin = auth('admin-api')->user();
        $data = $request->validated();
        $this->profileService->updateProfile($admin,$data);
        return response()->json([  'success' => true, 'message' => 'Profile updated successfully', 'data' => new AdminResource($admin),
        ]);
    }

    public function destroy(PasswordRequest $request)
    {
    $admin = auth('admin-api')->user();
    $this->profileService->updatePassword($admin,$request->validated() );

    }
}

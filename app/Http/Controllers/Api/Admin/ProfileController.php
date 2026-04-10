<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\AdminResource;
use App\Http\Requests\Api\Admin\ProfileRequest;
use App\Traits\fileUpload;

class ProfileController extends Controller
{

    use fileUpload;
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = auth('admin-api')->user();
        return response()->json([
            'success' => true,
            'data' => new AdminResource($admin),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        $admin = auth('admin-api')->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $deletePath = $this->deleteFile($admin->avatar);
            $avatarPath =$this->uploadFile($request->file('avatar'));
            $admin->avatar = $avatarPath;
            $data['avatar'] = $avatarPath;
        }

        $admin->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => new AdminResource($admin),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\UserResource;
use App\Traits\fileUpload;
use App\Http\Requests\Api\Front\ProfileRequest ;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{

    use fileUpload;
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
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
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $deletePath = $this->deleteFile($user->avatar);
            $avatarPath = $this->uploadFile($request->file('avatar'));
            $user->avatar = $avatarPath;
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => new UserResource($user),
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

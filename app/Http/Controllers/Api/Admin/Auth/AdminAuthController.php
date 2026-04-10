<?php
namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Api\Admin\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\AdminResource;

class AdminAuthController extends Controller 
{
    public function login(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        return $this->successResponse([
            'token' => $admin->createToken('admin_token')->plainTextToken,
            'admin' => new AdminResource($admin),
        ], ' successfully logged in');
    }

    protected function successResponse($data, $message = null, $code = 200) {
        return response()->json(['status' => 'success', 'message' => $message, 'data' => $data], $code);
    }

    protected function errorResponse($message, $code) {
        return response()->json(['status' => 'error', 'message' => $message], $code);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Front\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\UserResource;

class RegisterUserController extends Controller
{

    public function  register(RegisterUserRequest $request){
    $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'country' => $request->country,
    'city' => $request->city,
    'address'=>$request->address,
    'password' =>Hash::make($request->password)
    ]);
    $token =  $user->createToken('user-token')->plainTextToken;

    return $this->SuccessResponse([
        'user' => new UserResource($user),
        'token' =>$token

    ],'Successfully Registered In');
    }

    protected function SuccessResponse($data , $message = null , $code = 200){
        return response()->json(['status'=>'success','data',$data , 'message' =>$message ] ,$code);
    }
}

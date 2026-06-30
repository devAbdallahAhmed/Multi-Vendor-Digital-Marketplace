<?php
namespace App\Http\Controllers\Api\V1\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Api\UserResource;
use App\Traits\fileUpload;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use fileUpload;
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return $this->errorResponse('Invalid credentials',401);
        }

        return $this->SuccessResponse([
            'token' => $user->createToken('user-token')->plainTextToken,
            'user' => new  UserResource($user),
        ],' successfully logged in');

    }
    protected function SuccessResponse($data,$message = null , $code ='200'){
        return response()->json(['status'=> 'success', 'message' =>$message , 'data' => $data],$code);
    }
    protected function errorResponse($message ,$code){
        return response()->json(['status'=> 'error' , 'message' =>$message ],$code);
    }
}

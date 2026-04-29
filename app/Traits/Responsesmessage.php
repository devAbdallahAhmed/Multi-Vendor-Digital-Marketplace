<?php

namespace App\Traits;

trait ResponseMessage 
{


        protected  function successResponse($data , $message = null , $code = 200){
        return response()->json([
                    'status'  => 'success',
                    'message' => $message, 
                    'data'    => $data 
                ], $code);    }


}
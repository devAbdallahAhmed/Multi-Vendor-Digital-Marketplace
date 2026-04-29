<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUserCreateRequest;
use App\Http\Resources\Api\Admin\RoleResource;
use App\Http\Resources\Api\AdminResource;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Services\Admin\RoleUserService;
use App\Traits\ResponseMessage;
use App\Http\Requests\Admin\RoleUserUpdateRequest;

class RoleUserController extends Controller
{
    protected  $roleUserService;

    public function __construct(RoleUserService $roleUserService)
    {
        $this->roleUserService = $roleUserService;
    }

    public function index()
    {
        $admins = Admin::with('roles.permissions')->paginate(10);
      return  $this->successResponse([
        'message'=>'Admin Roles Retrieved Successfully',
    'data' =>  RoleResource::collection($admins)]);
     }
    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserCreateRequest $request)
    {
        $admin = auth('admin-api')->user();
     $this->roleUserService->storeUser($request->validated());
    return $this->successResponse(['data'=> AdminResource::collection($admin) , 'message'=> 'Created Role User']);
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
    public function update(RoleUserUpdateRequest $request)
    {
      $admin = auth('admin-api')->user();
     $this->roleUserService->updateUser( $admin,$request->validated());
    return $this->successResponse(['data'=>  new AdminResource($admin) , 'message'=> 'Updated Role User']);
    }

    public function destroy(Admin $role_user)
    {
        if (!$this->roleUserService->deleteUser($role_user)) {
            return $this->errorResponse('Cannot delete Super Admin', 403);
        }

        return $this->successResponse(null, 'Admin Deleted Successfully' );
    }

        protected  function successResponse($data , $message = null , $code = 200){
        return response()->json(['status'  => 'success','message' => $message, 'data'    => $data ], $code);    }


        protected  function errorResponse( $message = null , $code = 200){
         return response()->json(['status'  => 'success','message' => $message,], $code);    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\RoleRequest;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        $roles = Role::with('permissions')->get();
        return view('admin.access-management.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-management.role.create' , compact('permissions' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
        }
        NotificationService::created('Role created successfully');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        if($role->name === 'super admin') {
            NotificationService::error();
            return to_route('admin.roles.index');
        }
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-management.role.edit' , compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $role = Role::findOrFail($id);
         if($role->name === 'super admin') {
            NotificationService::error();
            return to_route('admin.roles.index');
        }
        $role->name = $request->name;
        $role->save();
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        NotificationService::updated('Role updated successfully');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
         if($role->name === 'super admin') {
            NotificationService::error();
            return to_route('admin.roles.index');
        }

        try{
        DB::beginTransaction();
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();
        DB::commit();
        NotificationService::deleted(__('Role deleted successfully'));
        return redirect()->route('admin.roles.index');

        }catch(\Exception $e){
                DB::rollBack();
            NotificationService::error(__('Failed to delete role: :message', ['message' => $e->getMessage()]));
            return redirect()->route('admin.roles.index');
        }

    }
}

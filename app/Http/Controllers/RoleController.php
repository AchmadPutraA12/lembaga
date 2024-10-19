<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\RolePermission;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use RealRashid\SweetAlert\Facades\Alert;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_role_permission'), 403);

        return  view('user_manajemen.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('create_role_permission'), 403);
        try{
            $permissions = RolePermission::select([
                'id',
                'name'
            ])->orderBy('id', 'asc')->get();
    
            return view('user_manajemen.role.create', [
                'permissions' => $permissions
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('create_role_permission'), 403);
        try{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'permissions' => 'required|array|min:1', // Setidaknya satu elemen dalam array diperlukan
                'permissions' => 'exists:permissions,name', // Pastikan semua nilai dalam array ada di tabel permissions
            ]);

            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            $role->givePermissionTo($request->permissions);
            Alert::success('Success', 'Data Telah Tersimpan');
            return redirect()->route('role');
        }catch(\Exception $e){
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('edit_role_permission'), 403);
        if ($role->name == 'super_admin') {
            abort(403, 'Tidak diizinkan untuk mengedit');
        }

        try{
            $permissions = RolePermission::select([
                'id',
                'name'
            ])->orderBy('id', 'asc')->get();
    
            // $role_has_permission
            return view('user_manajemen.role.edit', [
                'permissions' => $permissions,
                'role' => $role
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(Gate::denies('edit_role_permission'), 403);
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'permissions' => 'required|array|min:1',
                'permissions' => 'exists:permissions,name', // Pastikan semua nilai dalam array ada di tabel permissions
            ]);
    
            $role->update([
                'name' => $request->name
            ]);
    
            $role->syncPermissions($request->permissions);
            Alert::success('Success', 'Data Telah Tersimpan');
            return redirect()->route('role');

        }catch(\Exception $e){
            dd($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    // public function rolejson(){
    //     $roles = Role::select('roles.id as id', 'roles.name as role_name', 'permissions.name as permission_name', 'role_has_permissions.*')
    //     ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
    //     ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
    //     ->get();

    //     return Datatables::of($roles)->make(true);
    // }
    public function rolejson(){
        $roles = Role::select('roles.id as id', 'roles.name as role_name')
        ->where('roles.name', '!=', 'super_admin')
        ->get();

        return Datatables::of($roles)->make(true);
    }

}

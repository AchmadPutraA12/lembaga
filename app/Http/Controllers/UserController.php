<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OrganizationType;
use App\Models\UserOrganization;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_user'), 403);
        return view('user_manajemen.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('create_user'), 403);
        try{

            $roles = Role::select([
                'id',
                'name'
            ])
            ->where('roles.name', '!=', 'super_admin')
            ->get();
    
            $organization_types = OrganizationType::select([
                'organization_type_name',
                'id'
            ])->get();
    
            return view('user_manajemen.user.create', [
                'roles' => $roles,
                'organization_types' => $organization_types
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        abort_if(Gate::denies('create_user'), 403);
        try{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'nip' => 'required|string|unique:users,nip',
                'password' => 'required|string|min:8|confirmed',
                'is_active' => 'required|in:1,0',
                'role' => 'required|string|exists:roles,name',
                'id_organization_type' => 'required|exists:organization_types,id',
                'id_organization' => 'required|exists:organizations,org_defined_id'
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            DB::beginTransaction();
            try{

                $user = User::create($validatedData);
    
                $user->assignRole($request->role);    
                
                DB::commit();

                Alert::success('Success', 'Data Telah Tersimpan');
                return redirect()->route('user');

            }catch(\Exception $e){
                DB::rollback();
                dd($e->getMessage());

                // Alert::error('Fail', 'Data Gagal Disimpan');
                // return redirect()->route('badan-penyelenggara');
            }

        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('edit_user'), 403);
         // Cek apakah ID pengguna adalah 1
        if ($user->id == 1) {
            abort(403, 'Tidak diizinkan untuk mengedit pengguna dengan ID 1.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('edit_user'), 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function userjson(){
        $users = User::select([
            'id',
            'name',
            'email'
        ])
        ->where('users.name', '!=', 'super_admin')
        ->get();
        

        return Datatables::of($users)->make(true);
    }
}

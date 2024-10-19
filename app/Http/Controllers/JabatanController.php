<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Http\Requests\StoreJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_data_jabatan'), 403);
        
        return view('jabatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJabatanRequest $request)
    {
        abort_if(Gate::denies('create_data_jabatan'), 403);
        try {
            
            $validatedDataJabatan = $request->validate([
                'jabatan_nama' => 'required|string',
                'jabatan_active_status' => 'required|in:Aktif,Tidak Aktif'
            ]);            
            
            Jabatan::create($validatedDataJabatan);
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('jabatan-pimpinan');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJabatanRequest $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }

    public function jabatanbyidjson($id){
        $jabatanbyid = Jabatan::select([
            'id',
            'jabatan_nama',
            'jabatan_active_status'
        ])->where('id', '=', $id);

        return Datatables::of($jabatanbyid)->make(true);
    }

    public function jabatanjson(){
        $jabatan = Jabatan::select([
            'id',
            'jabatan_nama',
            'jabatan_active_status'
        ]);

        return Datatables::of($jabatan)->make(true);

    }

}

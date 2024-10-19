<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\PeringkatAkreditasi;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePeringkatAkreditasiRequest;
use App\Http\Requests\UpdatePeringkatAkreditasiRequest;


class PeringkatAkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_data_peringkat_akreditasi'), 403);
        
        return view('peringkat_akreditasi.index');

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
    public function store(StorePeringkatAkreditasiRequest $request)
    {

        abort_if(Gate::denies('create_data_peringkat_akreditasi'), 403);

        try {
            $validatedData = $request->validate([
                'peringkat_nama' => 'required|string',
                'peringkat_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'peringkat_akreditasi_active_status' => 'required|in:Aktif,Tidak Aktif'
            ]);
            
            if ($request->hasFile('peringkat_logo')) {
                $filenameSimpan = $this->generateFilename( $request->file('peringkat_logo')->getClientOriginalExtension(), 'logo_'.$request->peringkat_nama, rand(0,100));
                $path = $request->file('peringkat_logo')->storeAs('public/peringkat_akreditasi', $filenameSimpan);
                $validatedData['peringkat_logo'] = $filenameSimpan;
            }
            PeringkatAkreditasi::create($validatedData);
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('peringkat-akreditasi');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(PeringkatAkreditasi $peringkatAkreditasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeringkatAkreditasi $peringkatAkreditasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeringkatAkreditasiRequest $request, PeringkatAkreditasi $peringkatAkreditasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeringkatAkreditasi $peringkatAkreditasi)
    {
        //
    }

    public function peringkatakreditasijson(){
        $peringkatAkreditasi = PeringkatAkreditasi::select([
            'id',
            'peringkat_nama',
            'peringkat_logo',
        ]);
    
        return Datatables::of($peringkatAkreditasi)->make(true);
    }

    public function peringkatakreditasibyidjson($id){
        $peringkatAkreditasi = PeringkatAkreditasi::select([
            'id',
            'peringkat_nama',
            'peringkat_logo',
        ])->where('id', '=', $id);
    
        return Datatables::of($peringkatAkreditasi)->make(true);

    }
}

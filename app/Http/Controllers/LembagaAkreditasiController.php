<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use App\Models\LembagaAkreditasi;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreLembagaAkreditasiRequest;
use App\Http\Requests\UpdateLembagaAkreditasiRequest;

class LembagaAkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('access_data_lembaga_akreditasi'), 403);
        
        return view('lembaga_akreditasi.index');

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
    public function store(StoreLembagaAkreditasiRequest $request)
    {
        abort_if(Gate::denies('create_data_lembaga_akreditasi'), 403);

        try {
            $validatedData = $request->validate([
                'lembaga_nama' => 'required|string',
                'lembaga_nama_singkat' => 'required|string',
                'lembaga_status' => 'required|in:Aktif,Tidak Aktif',
                'lembaga_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            if ($request->hasFile('lembaga_logo')) {
                $filenameSimpan = $this->generateFilename($request->file('lembaga_logo')->getClientOriginalExtension(),'logo'.$request->lembaga_nama_singkat, rand(0,100));
                $path = $request->file('lembaga_logo')->storeAs('public/lembaga_akreditasi', $filenameSimpan);
                $validatedData['lembaga_logo'] = $filenameSimpan;
            }
            LembagaAkreditasi::create($validatedData);
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('lembaga-akreditasi');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LembagaAkreditasi $lembagaAkreditasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LembagaAkreditasi $lembagaAkreditasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLembagaAkreditasiRequest $request, LembagaAkreditasi $lembagaAkreditasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LembagaAkreditasi $lembagaAkreditasi)
    {
    
    }

    public function lembagaakreditasijson(){
        $lembagaAkreditasi = LembagaAkreditasi::select([
            'id',
            'lembaga_nama',
            'lembaga_nama_singkat',
            'lembaga_logo',
            'lembaga_status'
        ]);
        return Datatables::of($lembagaAkreditasi)->make(true);
    }

    public function lembagaakreditasibyidjson($id){
        $lembagaAkreditasi = LembagaAkreditasi::select([
            'id',
            'lembaga_nama',
            'lembaga_nama_singkat',
            'lembaga_logo',
            'lembaga_status'
        ])
        ->where('id', '=', $id);
        return Datatables::of($lembagaAkreditasi)->make(true);
    }

}

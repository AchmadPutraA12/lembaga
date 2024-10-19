<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Organization;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\PimpinanOrganisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePimpinanOrganisasiRequest;
use App\Http\Requests\UpdatePimpinanOrganisasiRequest;

class PimpinanOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('access_pimpinan_perguruan_tinggi'), 403);

        try{
            $id_perti = $request->input('id_perti');
            $organization = Organization::select([
                'org_defined_id', 'org_nama'
            ])
            ->where('org_defined_id', '=', $id_perti)
            ->where('id_organization_type', 3)
            ->first();

            if (!$id_perti || !$organization) {
                return response()->view('layouts.not_found.half', [], 403);
            }else{

                $jabatan_s = Jabatan::select([
                    'jabatan_nama', 'id'
                ])
                ->where('jabatan_active_status', '=', 'Aktif')
                ->whereNotIn('id', function ($query) use ($organization) {
                    $query->select('id_jabatan')
                        ->from('pimpinan_organisasis')
                        ->where('id_organization', $organization->org_defined_id);
                })
                ->get();    
                
                $pimpinan_perti = DB::table('pimpinan_organisasis')
                ->select('pimpinan_nama', 'id_jabatan', 'jabatan_nama', 'pimpinan_organisasis.created_at')
                ->join('jabatans', 'jabatans.id', '=', 'pimpinan_organisasis.id_jabatan')
                ->whereIn('id_jabatan', [1, 2, 3, 4, 5, 6])
                ->whereIn('pimpinan_organisasis.created_at', function ($query) {
                    $query->select(DB::raw('MAX(pimpinan_organisasis.created_at)'))
                        ->from('pimpinan_organisasis')
                        ->whereIn('id_jabatan', [1, 2, 3, 4, 5, 6])
                        ->groupBy('id_jabatan');
                })
                ->orderBy('id_jabatan', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
                return view('pimpinan_perti.index', [
                    'perti' => $organization,
                    'jabatan_s' => $jabatan_s,
                    'pimpinan_perti' => $pimpinan_perti
                ]);
            }
    
        }catch(\Exception $e){
            dd($e->getMessage());
        }


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
    public function store(StorePimpinanOrganisasiRequest $request)
    {
        abort_if(Gate::denies('create_pimpinan_perguruan_tinggi'), 403);

        try{

            if($request->input('id_organization') !=  request('id_perti')){
                Alert::error('Fail', 'Aktifitas Mencurigakan');
                return redirect()->route('pimpinan-perti', ['id_perti' => request('id_perti')]);
            }

            $validatedDataPimpinan = $request->validate([
                "pimpinan_nama" => "required|string",
                "pimpinan_tgl_awal" => "required|date",
                "pimpinan_tgl_akhir" => "required|date",
                'pimpinan_sk_dokumen' => 'required|mimes:pdf|max:2048',
                'id_jabatan' => 'required|exists:jabatans,id',
                'id_organization' => 'required|exists:organizations,org_defined_id',
                'pimpinan_status' => 'required|in:Aktif,Tidak Aktif'
            ]);

            // dd('line 108');

            if ($request->hasFile('pimpinan_sk_dokumen')) {
                $filenameSimpan = $this->generateFilename($request->file('pimpinan_sk_dokumen')->getClientOriginalExtension(),'sk_pimpinan_'.$request->pimpinan_nama, rand(0,100));
                $path = $request->file('pimpinan_sk_dokumen')->storeAs('public/organization/sk_pimpinan', $filenameSimpan);
                $validatedDataPimpinan['pimpinan_sk_dokumen'] = $filenameSimpan;
            }

            PimpinanOrganisasi::create($validatedDataPimpinan);
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('pimpinan-perti', ['id_perti'=>$validatedDataPimpinan['id_organization']]);
            
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        // dd($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(PimpinanOrganisasi $pimpinanOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PimpinanOrganisasi $pimpinanOrganisasi)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePimpinanOrganisasiRequest $request, PimpinanOrganisasi $pimpinanOrganisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PimpinanOrganisasi $pimpinanOrganisasi)
    {
        //
    }

    public function pimpinanpertibyidpertijson($id_perti){
        $pimpinanPerti = PimpinanOrganisasi::select([
            'pimpinan_organisasis.id',
            'pimpinan_organisasis.pimpinan_nama',
            'pimpinan_organisasis.pimpinan_tgl_awal',
            'pimpinan_organisasis.pimpinan_tgl_akhir',
            'jabatans.jabatan_nama',
            'pimpinan_organisasis.pimpinan_sk_dokumen'       
            
        ])->join('jabatans' , 'pimpinan_organisasis.id_jabatan' , '=' , 'jabatans.id')
        ->orderBy('pimpinan_organisasis.id_jabatan', 'asc')
        ->orderBy('pimpinan_organisasis.created_at', 'desc')
        ->where('pimpinan_organisasis.id_organization' , '=' , $id_perti)
        ->get();
    
        return Datatables::of($pimpinanPerti)->make(true);
    }

    public function pimpinanpertibyidjson($id){
        $pimpinanPerti = PimpinanOrganisasi::select([
            'pimpinan_organisasis.id',
            'pimpinan_organisasis.pimpinan_nama',
            'pimpinan_organisasis.id_jabatan',            
            'pimpinan_organisasis.id_jabatan',     
        ])
        ->orderBy('pimpinan_organisasis.id_jabatan', 'asc')
        ->orderBy('pimpinan_organisasis.created_at', 'desc')
        ->where('id', '=', $id)
        ->get();

        return Datatables::of($pimpinanPerti)->make(true);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Http\Requests\StoreProgramStudiRequest;
use App\Http\Requests\UpdateProgramStudiRequest;
use App\Models\Akreditasi;
use App\Models\Akta;
use App\Models\LembagaAkreditasi;
use App\Models\Organization;
use App\Models\PeringkatAkreditasi;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables;



class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('program-studi*')) {
            abort_if(Gate::denies('access_data_perguruan_tinggi'), 403);
            return view('program_studi.index');
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        abort_if(Gate::denies('create_data_program_studi'), 403);

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
            $lembaga_s = LembagaAkreditasi::select([
                'id', 'lembaga_nama', 'lembaga_nama_singkat', 'lembaga_logo'
            ])->get();
    
            $peringkat_s = PeringkatAkreditasi::select([
                'id', 'peringkat_nama', 'peringkat_logo'
            ])->get();
    
            return view('program_studi.create', [
                'lembaga_s' => $lembaga_s,
                'peringkat_s' => $peringkat_s,
    
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramStudiRequest $request)
    {
        abort_if(Gate::denies('create_data_program_studi'), 403);
        try {
            $validatedDataAgreement = $request->validate([
                'agreement' => 'required',
                'id_user' => 'required|exists:users,id',
                'id_organization' => 'required|exists:organizations,org_defined_id'
            ]);

            if($validatedDataAgreement['id_user'] ==  Auth::User()->id){
                $id_user = $validatedDataAgreement['id_user'];
            }else{
                Alert::error('Fail', 'Aktifitas Mencurigakan');
                return redirect()->route('perguruan-tinggi.show', ['id_perti' => request('id_perti')]);
            }

            //validated Data Perti
            if($validatedDataAgreement['id_organization'] !=  request('id_perti')){
                Alert::error('Fail', 'Aktifitas Mencurigakan');
                return redirect()->route('perguruan-tinggi.show', ['id_perti' => request('id_perti')]);
            }


            $validatedDataDigit = $request->validate([
                'kode_prodi_digits.*' => 'required|numeric|digits:1'
            ]);
            $digits = $request->input('kode_prodi_digits');
            $prodi_kode = implode('', $digits);
            $id_organization = $request->input('id_organization');

            // dd($prodi_kode);

            $validatedDataProdi = $request->validate([
                'prodi_nama' => 'required|string',
                'prodi_jenjang' => 'required|string',
                'prodi_active_status' => 'required|in:Aktif,Tidak Aktif',
            ]);

            $prodi_defined_id = $this->createDefinedId($prodi_kode);

            $validatedDataProdi['prodi_defined_id'] = $prodi_defined_id;
            $validatedDataProdi['id_organization'] = $id_organization;
            $validatedDataProdi['prodi_kode'] = $prodi_kode;
            $validatedDataProdi['id_user'] = $id_user;

            // dd($validatedDataProdi);

            $validatedDataAkta = $request->validate([
                'akta_nomor' => 'required|string|unique:aktas,akta_nomor',
                'akta_tgl_awal' => 'required|date',
                'akta_tgl_akhir' => 'required|date',
                'akta_status' => 'required|in:Aktif,Tidak Aktif',
                'akta_jenis' => 'required|in:Aktif,Tidak Aktif',
                'akta_dokumen' => 'required|mimes:pdf|max:2048'
            ]);
            $akta_defined_id = $this->createDefinedId(Akta::count()+1);
            $filenameSimpanAkta = $this->generateFilename($request->file('akta_dokumen')->getClientOriginalExtension(), 'akta_dokumen_prodi', $akta_defined_id);

            $validatedDataAkta['akta_defined_id'] = $akta_defined_id;
            $validatedDataAkta['id_user'] =  $id_user;
            $validatedDataAkta['id_prodi'] = $prodi_defined_id;
            $validatedDataAkta['akta_dokumen'] = $filenameSimpanAkta;

            // dd($validatedDataAkta);

            $validatedDataAkreditasi = $request->validate([
                'akreditasi_sk' => 'required|string',
                'akreditasi_tgl_awal' => 'string|date',
                'akreditasi_tgl_akhir' => 'string|date',
                'akreditasi_status' => 'string|required|in:Aktif,Berakhir',
                'id_lembaga_akreditasi' => 'required|string|exists:lembaga_akreditasis,id',
                'id_peringkat_akreditasi' => 'required|string|exists:peringkat_akreditasis,id',
                'akreditasi_dokumen' => 'required|mimes:pdf|max:2048'

            ]);
            $filenameSimpanSKAkreditasi = $this->generateFilename($request->file('akreditasi_dokumen')->getClientOriginalExtension(), 'sk_akreditasi_prodi', ProgramStudi::count()+1);

            $validatedDataAkreditasi['id_user'] = $id_user;
            $validatedDataAkreditasi['id_prodi'] = $prodi_defined_id;
            $validatedDataAkreditasi['akreditasi_dokumen'] = $filenameSimpanSKAkreditasi;

            // dd($validatedDataAkreditasi);

            if ($request->hasFile('akta_dokumen')) {
                $storeAkta = $request->file('akta_dokumen')->storeAs('public/organization/akta/prodi', $filenameSimpanAkta);
            }

            if ($request->hasFile('akreditasi_dokumen')) {
                $storeSKAkreditasi = $request->file('akreditasi_dokumen')->storeAs('public/organization/sk_akreditasi/prodi', $filenameSimpanSKAkreditasi);
            }        

            DB::beginTransaction();
            try {
                ProgramStudi::create($validatedDataProdi);
                Akta::create($validatedDataAkta);
                Akreditasi::create($validatedDataAkreditasi);

                DB::commit();
                Alert::success('Success', 'Data Telah Tersimpan');
                return redirect()->route('perguruan-tinggi.show', ['perguruan_tinggi' => $id_organization]);

            } catch (\Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }

            abort(404);

        } catch (\Exception $e) {
            dd($e->getMessage());
            // Alert::error('Fail', $e->getMessage());
            // return redirect()->route('program-studi.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramStudiRequest $request, ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        //
    }

    public function prodibyidpertijson($id_perti){
        $prodibyidperti = ProgramStudi::select([
            'prodi_nama',
            'prodi_kode',
            'prodi_defined_id',
            'prodi_jenjang',
            'prodi_active_status',
            
            'akreditasis.akreditasi_sk',
            'peringkat_akreditasis.peringkat_nama'
        ])
        ->join('akreditasis', 'akreditasis.id_prodi', '=', 'program_studis.prodi_defined_id')->latest('akreditasis.created_at')->take(1)
        ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
        ->where('program_studis.id_organization', '=', $id_perti)
        ->get();

        return Datatables::of($prodibyidperti)->make(true);
    }
}

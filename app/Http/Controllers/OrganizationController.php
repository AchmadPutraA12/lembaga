<?php

namespace App\Http\Controllers;

use App\Models\Akta;
use App\Models\Akreditasi;
use App\Models\Organization;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\LembagaAkreditasi;
use Illuminate\Support\Facades\DB;
use App\Models\PeringkatAkreditasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Kepemilikan;
use App\Models\PimpinanOrganisasi;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if($request->is('badan-penyelenggara*')) {
            abort_if(Gate::denies('access_data_badan_penyelenggara'), 403);

            return view('badan_penyelenggara.index');
        } elseif ($request->is('perguruan-tinggi*')) {
            abort_if(Gate::denies('access_data_perguruan_tinggi'), 403);

            return view('perguruan_tinggi.index');
        } else {
            abort(404);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->is('badan-penyelenggara*')) {
            abort_if(Gate::denies('create_data_badan_penyelenggara'), 403);
            return view('badan_penyelenggara.create');
        } elseif ($request->is('perguruan-tinggi*')) {
            abort_if(Gate::denies('create_data_perguruan_tinggi'), 403);

            $lembaga_s = LembagaAkreditasi::select([
                'id', 'lembaga_nama', 'lembaga_nama_singkat', 'lembaga_logo'
            ])->get();
            $peringkat_s = PeringkatAkreditasi::select([
                'id', 'peringkat_nama', 'peringkat_logo'
            ])->get();
            $badanPenyelenggara_s = Organization::select([
                'org_defined_id', 'org_nama', 'org_status', 'org_logo'
            ])
            ->where('organizations.id_organization_type', '=', 2)
            ->get();
            return view('perguruan_tinggi.create', [
                'lembaga_s' => $lembaga_s,
                'peringkat_s' => $peringkat_s,
                'badanPenyelenggara_s' => $badanPenyelenggara_s
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        if($request->is('badan-penyelenggara*')) {
            abort_if(Gate::denies('create_data_badan_penyelenggara'), 403);
            try{
                $validatedDataAgreement = $request->validate([
                    'agreement' => 'required',
                    'id_user' => 'required|exists:users,id'
                ]);

                if($validatedDataAgreement['id_user'] ==  Auth::User()->id){
                    $id_user = $validatedDataAgreement['id_user'];
                }else{
                    return false;
                }

                $validatedDataOrg = $request->validate([
                    'org_nama' => 'required|string',
                    'org_nama_singkat' => 'required|string',
                    'org_alamat' => 'required|string',
                    'org_kota' => 'required|string',
                    'org_email' => 'required|email|unique:organizations,org_email',
                    'org_website' => 'required|string|unique:organizations,org_website',
                    'org_telp' => 'required|numeric|unique:organizations,org_telp',
                    'org_status' => 'required|in:Aktif,Tidak Aktif',
                    'org_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
                ]);

                $org_defined_id = $this->createDefinedId(Organization::count()+1);
                $filenameSimpanOrg = $this->generateFilename($request->file('org_logo')->getClientOriginalExtension(), 'Logo_BP', $org_defined_id);
                $id_organization_type = 2; //2 karena 2 adalah badan penyelenggara

                $validatedDataOrg['org_kode'] = $this->generateIdLength(Organization::count()+1 ,6);
                $validatedDataOrg['org_defined_id'] = $org_defined_id;
                $validatedDataOrg['id_user'] = $id_user;
                $validatedDataOrg['org_logo'] = $filenameSimpanOrg;
                $validatedDataOrg['id_organization_type'] = $id_organization_type;

                // dd($validatedDataOrg);

                $validatedDataAkta = $request->validate([
                    'akta_nomor' => 'required|string|unique:aktas,akta_nomor',
                    'akta_tgl_awal' => 'required|date',
                    'akta_tgl_akhir' => 'required|date',
                    'akta_nama_notaris' => 'required|string',
                    'akta_kota_notaris' => 'required|string',
                    'akta_status' => 'required|in:Aktif,Tidak Aktif',
                    'akta_jenis' => 'required|in:Aktif,Tidak Aktif',
                    'akta_dokumen' => 'required|mimes:pdf|max:2048'
                ]);
                $akta_defined_id = $this->createDefinedId(Akta::count()+1);
                $filenameSimpanAkta = $this->generateFilename($request->file('akta_dokumen')->getClientOriginalExtension(), 'akta_dokumen', $akta_defined_id);

                $validatedDataAkta['akta_defined_id'] = $akta_defined_id;
                $validatedDataAkta['id_user'] =  $id_user;
                $validatedDataAkta['id_organization'] = $org_defined_id;
                $validatedDataAkta['akta_dokumen'] = $filenameSimpanAkta;

                if ($request->hasFile('org_logo')) {
                    $storeOrg = $request->file('org_logo')->storeAs('public/organization/logo/', $filenameSimpanOrg);
                }

                if ($request->hasFile('akta_dokumen')) {
                    $storeAkta = $request->file('akta_dokumen')->storeAs('public/organization/akta/', $filenameSimpanAkta);
                }

                DB::beginTransaction();
                try{

                    Organization::create($validatedDataOrg);
                    Akta::create($validatedDataAkta);

                    DB::commit();

                    Alert::success('Success', 'Data Telah Tersimpan');
                    return redirect()->route('badan-penyelenggara');

                }catch(\Exception $e){
                    DB::rollback();
                    dd($e->getMessage());

                    // Alert::error('Fail', 'Data Gagal Disimpan');
                    // return redirect()->route('badan-penyelenggara');
                }


            }catch(\Exception $e){
                Alert::error('Fail', $e->getMessage());
                return redirect()->route('badan-penyelenggara.create');
            }


        } elseif ($request->is('perguruan-tinggi*')) {
            abort_if(Gate::denies('create_data_perguruan_tinggi'), 403);
            // dd($request);
            try{

                $validatedDataDigit = $request->validate([
                    'kode_pt_digits.*' => 'required|numeric|digits:1'
                ]);
                $digits = $request->input('kode_pt_digits');
                $org_kode = implode('', $digits);

                $validatedDataAgreement = $request->validate([
                    'agreement' => 'required',
                    'id_user' => 'required|exists:users,id'
                ]);

                if($validatedDataAgreement['id_user'] ==  Auth::User()->id){
                    $id_user = $validatedDataAgreement['id_user'];
                }else{
                    return false;
                }

                $validatedDataOrg = $request->validate([
                    'org_nama' => 'required|string',
                    'org_nama_singkat' => 'required|string',
                    'org_alamat' => 'required|string',
                    'org_kota' => 'required|string',
                    'org_email' => 'required|email|unique:organizations,org_email',
                    'org_website' => 'required|string|unique:organizations,org_website',
                    'org_telp' => 'required|numeric|unique:organizations,org_telp',
                    'org_status' => 'required|in:Aktif,Tidak Aktif',
                    'org_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
                $org_defined_id = $this->createDefinedId(Organization::count()+1);
                $filenameSimpanOrg = $this->generateFilename($request->file('org_logo')->getClientOriginalExtension(), 'Logo_PT_'.$validatedDataOrg['org_nama_singkat'], $org_defined_id);
                $id_organization_type = 3; //3 karena 3 adalah perguruan tinggi

                $validatedDataOrg['org_kode'] = $org_kode;
                $validatedDataOrg['org_defined_id'] = $org_defined_id;
                $validatedDataOrg['id_user'] = $id_user;
                $validatedDataOrg['org_logo'] = $filenameSimpanOrg;
                $validatedDataOrg['id_organization_type'] = $id_organization_type;

                $validatedDataAkta = $request->validate([
                    'akta_nomor' => 'required|string|unique:aktas,akta_nomor',
                    'akta_tgl_awal' => 'required|date',
                    'akta_tgl_akhir' => 'required|date',
                    'akta_nama_notaris' => 'required|string',
                    'akta_kota_notaris' => 'required|string',
                    'akta_status' => 'required|in:Aktif,Tidak Aktif',
                    'akta_jenis' => 'required|in:Aktif,Tidak Aktif',
                    'akta_dokumen' => 'required|mimes:pdf|max:2048'
                ]);
                $akta_defined_id = $this->createDefinedId(Akta::count()+1);
                $filenameSimpanAkta = $this->generateFilename($request->file('akta_dokumen')->getClientOriginalExtension(), 'akta_dokumen', $akta_defined_id);

                $validatedDataAkta['akta_defined_id'] = $akta_defined_id;
                $validatedDataAkta['id_user'] =  $id_user;
                $validatedDataAkta['id_organization'] = $org_defined_id;
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
                $filenameSimpanSKAkreditasi = $this->generateFilename($request->file('akreditasi_dokumen')->getClientOriginalExtension(), 'sk_akreditasi_pt_'.$validatedDataOrg['org_nama_singkat'], Akreditasi::count()+1);

                $validatedDataAkreditasi['id_user'] = $id_user;
                $validatedDataAkreditasi['id_organization'] = $org_defined_id;
                $validatedDataAkreditasi['akreditasi_dokumen'] = $filenameSimpanSKAkreditasi;

                // dd($validatedDataAkreditasi);

                $validatedDataKepemilikan = $request->validate([
                    'parent_organization_id' => 'required|exists:organizations,org_defined_id'
                ]);
                $validatedDataKepemilikan['child_organization_id'] = $org_defined_id;

                if ($request->hasFile('org_logo')) {
                    $storeOrg = $request->file('org_logo')->storeAs('public/organization/logo/', $filenameSimpanOrg);
                }

                if ($request->hasFile('akta_dokumen')) {
                    $storeAkta = $request->file('akta_dokumen')->storeAs('public/organization/akta/', $filenameSimpanAkta);
                }

                if ($request->hasFile('akreditasi_dokumen')) {
                    $storeSKAkreditasi = $request->file('akreditasi_dokumen')->storeAs('public/organization/sk_akreditasi/', $filenameSimpanSKAkreditasi);
                }

                DB::beginTransaction();
                try{

                    Organization::create($validatedDataOrg);
                    Akta::create($validatedDataAkta);
                    Akreditasi::create($validatedDataAkreditasi);
                    Kepemilikan::create($validatedDataKepemilikan);

                    DB::commit();

                    Alert::success('Success', 'Data Telah Tersimpan');
                    return redirect()->route('perguruan-tinggi');

                }catch(\Exception $e){
                    DB::rollback();
                    dd($e->getMessage());

                    // Alert::error('Fail', 'Data Gagal Disimpan');
                    // return redirect()->route('badan-penyelenggara');
                }



            }catch(\Exception $e){
                dd($e->getMessage());
            }
        } else {
            abort(404);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization, Request $request, $org_defined_id)
    {
        if($request->is('badan-penyelenggara*')) {
            abort_if(Gate::denies('show_data_badan_penyelenggara'), 403);
            try{
                if (Gate::allows('view_all_badan_penyelenggara')) {
                    //lanjutkan  proses jika diizinkan
                } elseif(Gate::allows('view_restrict_badan_penyelenggara')) {
                    if (auth()->user()->id_organization_type == 1){
                    //lanjutkan  proses jika diizinkan
                    }elseif(auth()->user()->id_organization_type == 2){
                        if($org_defined_id != auth()->user()->id_organization){
                            Alert::error('Fail', 'Anda Tidak Memiliki Akses');
                            return redirect()->route('badan-penyelenggara');                
                        }
                    }elseif(auth()->user()->id_organization_type == 3){

                        $badanPenyelenggaraByIdPT = Kepemilikan::select([
                            'organizations.org_defined_id'
                        ])
                        ->join('organizations', 'organizations.org_defined_id', '=', 'kepemilikans.parent_organization_id')
                        ->where('kepemilikans.parent_organization_id', '=', $org_defined_id)->latest('kepemilikans.created_at')
                        ->where('kepemilikans.child_organization_id', '=', auth()->user()->id_organization)
                        ->first();

                        if (!$badanPenyelenggaraByIdPT) {
                            // Jika tidak ada hasil dari query
                            Alert::error('Fail', 'Aktifitas Mencurigakan');
                            return redirect()->route('badan-penyelenggara');            
                        }                   
                    }else{
                        Alert::error('Fail', 'Anda Tidak Memiliki Akses');
                        return redirect()->route('badan-penyelenggara');            
                    }
                }else{
                    Alert::erro('Fail', 'Anda Tidak Memiliki Akses');
                    return redirect()->route('badan-penyelenggara');            
                }

                $org = Organization::select([
                    'organizations.org_nama',
                    'organizations.org_nama_singkat',
                    'organizations.org_kode',
                    'organizations.org_defined_id',
                    'organizations.org_email',
                    'organizations.org_telp',
                    'organizations.org_kota',
                    'organizations.org_alamat',
                    'organizations.org_website',
                    'organizations.org_logo',
                    'organizations.org_status',

                    'aktas.akta_nomor',
                    'aktas.akta_tgl_awal',
                    'aktas.akta_tgl_akhir',
                    'aktas.akta_kota_notaris',
                    'aktas.akta_status',
                    'aktas.akta_dokumen',
                ])
                ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')->latest('aktas.created_at')
                ->where('org_defined_id', '=', $org_defined_id)
                ->first();    

                $perguruantinggi = Kepemilikan::select([
                    'organizations.org_defined_id',
                    'organizations.org_nama_singkat',
                    'organizations.org_logo',
                    'organizations.org_nama',
                ])
                ->join('organizations', 'organizations.org_defined_id', '=', 'kepemilikans.child_organization_id')
                ->where('kepemilikans.parent_organization_id', '=', $org_defined_id)
                ->get();

                return view('badan_penyelenggara.detail', [
                    'bp' => $org,
                    'perguruantinggi' => $perguruantinggi
                ]);
            }catch(\Exception $e){
                dd($e->getMessage());
            }

        } elseif ($request->is('perguruan-tinggi*')) {
            abort_if(Gate::denies('show_data_perguruan_tinggi'), 403);
            try{

                // Memeriksa apakah pengguna memiliki izin untuk melakukan tindakan tertentu
                if (Gate::allows('view_all_perguruan_tinggi')) {
                    //lanjutkan  proses jika diizinkan
                } elseif(Gate::allows('view_restrict_perguruan_tinggi')) {
                    if (auth()->user()->id_organization_type == 1){
                    //lanjutkan  proses jika diizinkan
                    }elseif(auth()->user()->id_organization_type == 2){
                        $perguruantinggi = DB::table('kepemilikans')->select([
                            'organizations.org_defined_id',
                        ])
                        ->join('organizations', 'organizations.org_defined_id', '=', 'kepemilikans.child_organization_id')
                        ->where('kepemilikans.parent_organization_id', '=', auth()->user()->id_organization)->latest('kepemilikans.created_at')
                        ->where('organizations.org_defined_id', '=', $org_defined_id)
                        ->first();

                        if (!$perguruantinggi) {
                            // Jika tidak ada hasil dari query
                            Alert::error('Fail', 'Aktifitas Mencurigakan');
                            return redirect()->route('perguruan-tinggi');            
                        }                   
                    }elseif(auth()->user()->id_organization_type == 3){
                        if($org_defined_id != auth()->user()->id_organization){
                            Alert::error('Fail', 'Aktifitas Mencurigakan');
                            return redirect()->route('perguruan-tinggi');            
                        }
                    }else{
                        Alert::error('Fail', 'Anda Tidak Memiliki Akses');
                        return redirect()->route('perguruan-tinggi');            
                    }
                }else{
                    Alert::erro('Fail', 'Anda Tidak Memiliki Akses');
                    return redirect()->route('perguruan-tinggi');            
                }


                $org = Organization::select([
                    'organizations.org_nama',
                    'organizations.org_nama_singkat',
                    'organizations.org_kode',
                    'organizations.org_defined_id',
                    'organizations.org_email',
                    'organizations.org_telp',
                    'organizations.org_kota',
                    'organizations.org_alamat',
                    'organizations.org_website',
                    'organizations.org_logo',
                    'organizations.org_status',
    
                    'aktas.akta_nomor',
                    'aktas.akta_tgl_awal',
                    'aktas.akta_tgl_akhir',
                    'aktas.akta_kota_notaris',
                    'aktas.akta_status',
                    'aktas.akta_dokumen',
    
                    'akreditasis.akreditasi_sk',
                    'akreditasis.akreditasi_tgl_awal',
                    'akreditasis.akreditasi_tgl_akhir',
                    'akreditasis.akreditasi_status',
                    'akreditasis.akreditasi_dokumen',
                    'peringkat_akreditasis.peringkat_nama',
                    'peringkat_akreditasis.peringkat_logo',
                    'lembaga_akreditasis.lembaga_nama',
                    'lembaga_akreditasis.lembaga_nama_singkat',
                    'lembaga_akreditasis.lembaga_logo',

                    'kepemilikans.parent_organization_id',
                    'parent_org.org_nama as parent_nama',
                    'parent_org.org_logo as parent_logo'
                ])
                ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')->latest('aktas.created_at')
                ->join('akreditasis', 'akreditasis.id_organization', '=', 'organizations.org_defined_id')->latest('akreditasis.created_at')
                ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
                ->join('lembaga_akreditasis', 'lembaga_akreditasis.id', '=', 'akreditasis.id_lembaga_akreditasi')
                ->join('kepemilikans', 'kepemilikans.child_organization_id', '=', 'organizations.org_defined_id')->latest('kepemilikans.created_at')
                ->join('organizations as parent_org', 'parent_org.org_defined_id', '=', 'kepemilikans.parent_organization_id')
                ->where('organizations.org_defined_id', '=', $org_defined_id)
                ->first();    

                // abort_if(Gate::denies('access_data_perguruan_tinggi'), 403);
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
                                                
                return view('perguruan_tinggi.detail', [
                    'perti' => $org,
                    'pimpinan_perti' => $pimpinan_perti
                ]);
            }catch(\Exception $e){
                dd($e->getMessage());
            }

        } else {
            abort(404);
        }
       
                                
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        //
    }

    public function organizationbyidorganizationtype($id_organization_type){
        $organizationByIdOrganizationType = Organization::select([
            'org_defined_id',
            'org_nama',
            'org_status',
            'org_logo'
        ])->where('id_organization_type', '=', $id_organization_type)->get();

        // if ($organizationByIdOrganizationType->isEmpty()) {
        //     return response()->json([]); // Mengembalikan array kosong jika tidak ada data
        // }
        return Datatables::of($organizationByIdOrganizationType)->make(true);
    }

    public function organizationbydefinedid($org_defined_id){
        $organizationByOrgDefinedId = Organization::select([
            'org_defined_id',
            'org_nama',
            'org_status',
            'org_logo'
        ])->where('org_defined_id', '=', $org_defined_id)->get();

        // if ($organizationByOrgDefinedId->isEmpty()) {
        //     return response()->json([]); // Mengembalikan array kosong jika tidak ada data
        // }
        return Datatables::of($organizationByOrgDefinedId)->make(true);
    }

    public function badanpenyelenggarajson(){
        $id_bp = 2;
        $badanPenyelenggara = Organization::select([
            'organizations.org_defined_id',
            'org_nama',
            'org_status',
            'aktas.akta_nomor',
            'org_logo',
            'org_nama_singkat'
        ])
        ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')
        ->where('organizations.id_organization_type', '=', $id_bp)
        ->get();

        // if ($badanPenyelenggara->isEmpty()) {
        //     return response()->json([]);
        // }
        return Datatables::of($badanPenyelenggara)->make(true);
    }

    public function badanpenyelenggarabyidjson($org_defined_id){
        $id_bp = 2;
        $badanPenyelenggaraById = Organization::select([
            'organizations.org_defined_id',
            'organizations.org_nama',
            'organizations.org_status',
            'aktas.akta_nomor',
            'organizations.org_logo',
            'organizations.org_nama_singkat'
        ])
        ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')
        ->where('organizations.org_defined_id', '=', $org_defined_id)
        ->where('organizations.id_organization_type', '=', $id_bp)
        ->get();

        // if ($badanPenyelenggaraById->isEmpty()) {
        //     return response()->json([]);
        // }
        return Datatables::of($badanPenyelenggaraById)->make(true);
    }

    public function badanpenyelenggarabyidptjson($id_pt){
        $badanPenyelenggaraByIdPT = Kepemilikan::select([
            'organizations.org_defined_id',
            'organizations.org_nama',
            'organizations.org_status',
            'aktas.akta_nomor',
            'organizations.org_logo',
            'organizations.org_nama_singkat'
        ])
        ->join('organizations', 'organizations.org_defined_id', '=', 'kepemilikans.parent_organization_id')
        ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')
        ->where('kepemilikans.child_organization_id', '=', $id_pt)
        ->get();

        // if ($badanPenyelenggaraByIdPT->isEmpty()) {
        //     return response()->json([]);
        // }
        return Datatables::of($badanPenyelenggaraByIdPT)->make(true);
    }

    public function badanpenyelenggaradefault(){
        $id_bp = -1;
        $badanPenyelenggaraDefault = Organization::select([
            'organizations.org_defined_id',
            'organizations.org_nama',
            'organizations.org_status',
            'aktas.akta_nomor',
            'organizations.org_logo',
            'organizations.org_nama_singkat'
        ])
        ->join('aktas', 'aktas.id_organization', '=', 'organizations.org_defined_id')
        ->where('organizations.org_defined_id', '=', $id_bp)
        ->get();

        // if ($badanPenyelenggaraDefault->isEmpty()) {
        //     return response()->json([]);
        // }
        return Datatables::of($badanPenyelenggaraDefault)->make(true);

    }

    public function perguruantinggijson(){
        $id_pt = 3;
        $perguruantinggi = Organization::select([
            'org_defined_id',
            'org_kode',
            'org_nama_singkat',
            'org_nama',
            'org_kota',
            'org_status',
            'org_logo',
            'org_nama_singkat',
            'peringkat_akreditasis.peringkat_nama'
        ])
        ->join('akreditasis', 'akreditasis.id_organization', '=', 'organizations.org_defined_id')
        ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
        ->where('organizations.id_organization_type', '=', $id_pt)
        ->get();
        // if ($perguruantinggi->isEmpty()) {
        //     return response()->json([]);
        // }

        return Datatables::of($perguruantinggi)->make(true);
    }

    public function perguruantinggibyidjson($id){
        $perguruantinggi = Organization::select([
            'organizations.org_defined_id',
            'organizations.org_kode',
            'organizations.org_nama_singkat',
            'organizations.org_nama',
            'organizations.org_kota',
            'organizations.org_status',
            'organizations.org_logo',
            'organizations.org_nama_singkat',
            'peringkat_akreditasis.peringkat_nama'

        ])
        ->join('akreditasis', 'akreditasis.id_organization', '=', 'organizations.org_defined_id')
        ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
        ->where('organizations.org_defined_id', '=', $id)->get();
        // if ($perguruantinggi->isEmpty()) {
        //     return response()->json([]);
        // }

        return Datatables::of($perguruantinggi)->make(true);
    }

    public function perguruantinggibyidbpjson($id_bp){
        $perguruantinggi = Kepemilikan::select([
            'organizations.org_defined_id',
            'organizations.org_kode',
            'organizations.org_nama_singkat',
            'organizations.org_nama',
            'organizations.org_kota',
            'organizations.org_status',
            'organizations.org_logo',
            'organizations.org_nama_singkat',
            'peringkat_akreditasis.peringkat_nama'

        ])
        ->join('organizations', 'organizations.org_defined_id', '=', 'kepemilikans.child_organization_id')
        ->join('akreditasis', 'akreditasis.id_organization', '=', 'organizations.org_defined_id')
        ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
        ->where('kepemilikans.parent_organization_id', '=', $id_bp)
        ->get();
        // if ($perguruantinggi->isEmpty()) {
        //     return response()->json([]);
        // }

        return Datatables::of($perguruantinggi)->make(true);
    }

    public function perguruantinggidefault(){
        $id_pt = 0;
        $perguruantinggidefault = Organization::select([
            'org_defined_id',
            'org_kode',
            'org_nama_singkat',
            'org_nama',
            'org_kota',
            'org_status',
            'org_logo',
            'org_nama_singkat',
            'peringkat_akreditasis.peringkat_nama'
        ])
        ->join('akreditasis', 'akreditasis.id_organization', '=', 'organizations.org_defined_id')
        ->join('peringkat_akreditasis', 'peringkat_akreditasis.id', '=', 'akreditasis.id_peringkat_akreditasi')
        ->where('organizations.id_organization_type', '=', $id_pt)
        ->get();

        // if ($perguruantinggidefault->isEmpty()) {
        //     return response()->json([]);
        // }

        return Datatables::of($perguruantinggidefault)->make(true);
    }

}

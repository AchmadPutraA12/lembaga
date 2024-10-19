@extends('layouts.master')

@section('page-css')
    
@endsection

@section('main-content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Blank</h1>
        <ul>
            <li><a href="">Pages</a></li>
            <li>Blank</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div><!-- end of main-content -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <h4>Identitas Badan Penyelenggara</h4>
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <img class="img-fluid rounded mb-2" src="{{ asset('storage/organization/logo/'.$bp->org_logo) }}" alt="" />
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <h2 class="font-weight-bold text-center">{{ $bp->org_nama }}</h2>
                        </div>                        
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i>Kontak</p>
                                <table>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $bp->org_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>:</td>
                                        <td>{{ $bp->org_telp }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i>Alamat</p>
                                <span>
                                    {{ $bp->org_alamat }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i>Status</p>
                                <span>
                                    {{ $bp->org_status }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i>Nomor Akta</p>
                                <span>
                                    {{ $bp->akta_nomor }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i>Tanggal Berlaku Akta</p>
                                <span>
                                    {{ $bp->akta_tgl_awal }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i>Status Akta</p>
                                <span>
                                    {{ $bp->akta_status }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">
                                    <i class="i-Cloud-Weather text-16 mr-1"></i>
                                    File Akta
                                </p>
                                <span>
                                    <i class="text-20 bi bi-file-earmark-pdf"></i>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a download href="{{ asset('storage/organization/akta/'.$bp->akta_dokumen) }}" class="btn btn-sm btn-primary"><i class="bi bi-download"></i></a>
                                        <a href="{{ asset('storage/organization/akta/'.$bp->akta_dokumen) }}" class="btn btn-sm btn-secondary"><i class="bi bi-eye"></i></a>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i>Nomor Surat Keputusan</p>
                                <span>
                                    {{ $bp->kumham_sk }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i>Tanggal Berlaku SK</p>
                                <span>
                                    {{ $bp->kumham_tgl_sk }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i>Jenis SK</p>
                                <span>
                                    {{ $bp->kumham_jenis }}
                                </span>
                            </div>
                            <div class="mb-4">
                                <p class="text-primary mb-1">
                                    <i class="i-Cloud-Weather text-16 mr-1"></i>
                                    File Akta
                                </p>
                                <span>
                                    <i class="text-20 bi bi-file-earmark-pdf"></i>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="bi bi-download"></i></a>
                                        <a href="#" class="btn btn-sm btn-secondary"><i class="bi bi-eye"></i></a>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr />
                    @can('show_data_perguruan_tinggi')                            
                    <h4>Daftar Perguruan Tinggi</h4>
                    <p class="mb-4">Daftar perguruan tinggi di bawah {{ $bp->org_nama }}</p>
                        
                    <div class="row justify-content-center">
                        @foreach ($perguruantinggi as $item)
                        <div class="col-md-3">
                            <div class="card card-profile-1 mb-4">
                                <div class="card-body text-center">
                                    <div class="avatar box-shadow-2 mb-3">
                                        <img src="{{ asset('storage/organization/logo/'.$item->org_logo) }}" alt="logo_pt" />
                                    </div>
                                    <h5 class="m-3">{{ $item->org_nama }}</h5>
                                    <a href="{{ route('perguruan-tinggi.show', ['perguruan_tinggi' => $item->org_defined_id]) }}" class="btn btn-primary btn-rounded">Detail</a>
                                </div>
                            </div>
                        </div>                            
                        @endforeach
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
    
@endsection
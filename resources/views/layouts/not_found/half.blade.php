@extends('layouts.master')

@section('page-css')
    
@endsection

@section('main-content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Halaman Tidak Tersedia</h1>
        <ul>
            <li><a href="">Pages</a></li>
            <li>Halaman Tidak Tersedia</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div><!-- end of main-content -->
    <div class="row">
        <div class="col-md-12 mb-4">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Maaf!</h4>
                        <p>Halaman yang Anda cari tidak tersedia.</p>
                        <hr>
                        <p class="mb-0">Silakan periksa kembali URL yang Anda masukkan atau hubungi administrator.</p>
                    </div>
                
        </div>
    </div>
</div>

@endsection

@section('page-js')
    
@endsection

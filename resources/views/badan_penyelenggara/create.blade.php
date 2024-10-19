@extends('layouts.master')

@section('page-css')
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('main-content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        {{-- <h1 class="mr-2">{{ $page_title }}</h1> --}}
       
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <form action="{{ route('badan-penyelenggara') }}" method="post" enctype="multipart/form-data">
        @csrf

        <button class="btn btn-primary ripple mb-3" type="submit">Submit</button>

        <div class="row ">
            <div class="col-md-8 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_nama">Nama Badan Penyelenggara<span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_nama" rows="3" name="org_nama"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_alamat">Alamat Badan Penyelenggara <span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_alamat" rows="3" name="org_alamat"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_nama_singkat">Akronim Badan Penyelenggara <span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_nama_singkat" rows="2" name="org_nama_singkat"  required></textarea>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="org_kota">Kota Badan Penyelenggara <span style="color: red">*</span></label>
                                <select class="form-control select2" id="org_kota" name="org_kota" required>
                                    <option>Pilih</option>
                                    <!-- Opsi dari API akan ditambahkan di sini -->
                                </select>
                            </div>                            
                            {{-- <div class="col-md-6 form-group mb-3">
                                <label for="org_email">Email Badan Penyelenggara <span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_email" rows="2" name="org_email"  required></textarea>
                            </div> --}}
                            <div class="col-md-8">
                            <label for="org_alamat">Kontak Badan Penyelenggara</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">E-mail@<span style="color: red">*</span></span></div>
                                    <input class="form-control" type="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required name="org_email"/>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Telepon<span style="color: red">*</span></span></div>
                                    <input class="form-control" type="text" placeholder="Telepon" aria-label="Telepon" aria-describedby="basic-addon1" required name="org_telp"/>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Website<span style="color: red">*</span></span></div>
                                    <input class="form-control" type="text" placeholder="Website" aria-label="Website" aria-describedby="basic-addon1" required name="org_website" />
                                </div>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="org_status">Status Badan Penyelenggara<span style="color: red">*</span></label>
                                <select class="form-control mb-1" id="org_status" name="org_status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <label for="">Logo Badan Penyelenggara<span style="color: red">*</span><small>jpg/jpeg/png</small></label>
                        <div class="card o-hidden mb-2">
                            <center>
                                <iframe align="center" frameborder='0' id="blah" height="245" ></iframe>
                            </center>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input class="custom-file-input" id="logoInp" type="file" aria-describedby="inputGroupFileAddon01" name="org_logo" required/>
                                <label class="custom-file-label" for="logoInp" id="imgLabelLogo">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="akta_nomor">Nomor Akta<span style="color: red">*</span></label>
                                <textarea class="form-control" id="akta_nomor" rows="2" name="akta_nomor"  required></textarea>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="akta_tgl_awal"><small>Tanggal Mulai Akta</small><span style="color: red">*</span></label>
                                <input class="form-control" style="height: 50px" id="akta_tgl_awal" type="date" name="akta_tgl_awal" required />
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="akta_tgl_akhir"><small>Tanggal Berakhir Akta</small><span style="color: red">*</span></label>
                                <input class="form-control" style="height: 50px" id="akta_tgl_akhir" type="date" name="akta_tgl_akhir" required />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akta_nama_notaris">Nama Notaris<span style="color: red">*</span></label>
                                <textarea class="form-control" id="akta_nama_notaris" rows="2" name="akta_nama_notaris" required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akta_kota_notaris">Kota Notaris<span style="color: red">*</span></label>
                                <select class="form-control select2" id="akta_kota_notaris" name="akta_kota_notaris" required>
                                    <option>Pilih</option>
                                    <!-- Opsi dari API akan ditambahkan di sini -->
                                </select>
                            </div>                            
                           
                            <div class="col-md-6 form-group mb-3">
                                <label for="akta_status">Status Akta<span style="color: red">*</span></label>
                                <select class="form-control mb-1" id="akta_status" name="akta_status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akta_jenis">Jenis Akta<span style="color: red">*</span></label>
                                <select class="form-control mb-1" id="akta_jenis" name="akta_jenis">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <label for="">File Akta<span style="color: red">*</span><small>pdf</small></label>
                        <div class="card o-hidden mb-2">
                            <iframe id="akta_preview" height="175" frameborder="0"></iframe>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input class="custom-file-input" id="aktaFileInp" type="file" aria-describedby="inputGroupFileAddon01" name="akta_dokumen" required/>
                                <label class="custom-file-label" for="inputGroupFile01" id="aktaFileLabelLogo">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        @include('layouts.agreement')

    </form>

</div>

@endsection

@section('page-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(selector).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        
        $("#logoInp").change(function(){
            readURL(this, '#blah');
        });

        // Ketika pengguna memilih file img, perbarui label
        $('#logoInp').change(function() {
            var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap

            // Memeriksa panjang nama file
            if (fileName.length > 20) {
                // Jika lebih dari 10 karakter, singkat nama file
                var shortenedFileName = fileName.substr(0, 15) + '...' + fileName.substr(-7);
                $('#imgLabelLogo').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
            } else {
                // Jika tidak, gunakan nama file lengkap
                $('#imgLabelLogo').text(fileName); // Mengatur label dengan nama file
            }
        });


    </script>

    <script>

        $("#aktaFileInp").change(function(){
            readURL(this, '#akta_preview');
        });

        // Ketika pengguna memilih file akta, perbarui label
        $('#aktaFileInp').change(function() {
            var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap

            // Memeriksa panjang nama file
            if (fileName.length > 20) {
                // Jika lebih dari 20 karakter, singkat nama file
                var shortenedFileName = fileName.substr(0, 15) + '...' + fileName.substr(-7);
                $('#aktaFileLabelLogo').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
            } else {
                // Jika tidak, gunakan nama file lengkap
                $('#aktaFileLabelLogo').text(fileName); // Mengatur label dengan nama file
            }
        });

    </script>

    <script>
        // Ambil data dari API dan isi opsi select menggunakan Select2
        $(document).ready(function() {
            // Ambil data dari API
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json`)
                .then(response => response.json())
                .then(data => {
                    // Iterasi melalui setiap item dalam array data.data
                    $.each(data, function(index, item) {
                        $('#org_kota').append('<option value=" ' + item.name + '"> ' + item.name + '</option>');
                    });

                    $.each(data, function(index, item) {
                        $('#akta_kota_notaris').append('<option value=" ' + item.name + '"> ' + item.name + '</option>');
                    });

                    // Inisialisasi Select2
                    $('#org_kota').select2();
                    $('#akta_kota_notaris').select2();
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

                        

@endsection
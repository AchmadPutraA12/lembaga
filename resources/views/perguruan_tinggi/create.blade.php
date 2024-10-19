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

    <form action="{{ route('perguruan-tinggi') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <button class="btn btn-primary ripple mb-3" type="submit">Submit</button>

        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="perti_kode">Kode PT<span style="color: red">*</span></label>
                            </div>
                        </div>
                        <div class="row mr-2">
                            <div class="col-md-2 col-2">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit1" maxlength="1" pattern="[0-9]" required onkeyup="moveToNextInput(this, 'digit2')">
                            </div>
                            <div class="col-md-2 col-2">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit2" maxlength="1" pattern="[0-9]" required onkeyup="moveToNextInput(this, 'digit3')">
                            </div>
                            <div class="col-md-2 col-2 ">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit3" maxlength="1" pattern="[0-9]" required onkeyup="moveToNextInput(this, 'digit4')">
                            </div>
                            <div class="col-md-2 col-2">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit4" maxlength="1" pattern="[0-9]" required onkeyup="moveToNextInput(this, 'digit5')">
                            </div>
                            <div class="col-md-2 col-2">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit5" maxlength="1" pattern="[0-9]" required onkeyup="moveToNextInput(this, 'digit6')">
                            </div>
                            <div class="col-md-2 col-2">
                                <input type="text" style="width:50px; height: 50px; font-size: 24px" class="form-control text-center font-weight-bold" name="kode_pt_digits[]" id="digit6" maxlength="1" pattern="[0-9]" required>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row ">
            <div class="col-md-8 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_nama">Nama Perguruan Tinggi<span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_nama" rows="3" name="org_nama"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_alamat">Alamat Perguruan Tinggi <span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_alamat" rows="3" name="org_alamat"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="org_nama_singkat">Akronim Perguruan Tinggi <span style="color: red">*</span></label>
                                <textarea class="form-control" id="org_nama_singkat" rows="2" name="org_nama_singkat"  required></textarea>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="org_kota">Kota Perguruan Tinggi<span style="color: red">*</span></label>
                                <select class="form-control select2" id="org_kota" name="org_kota" required>
                                    <option>Pilih</option>
                                    <!-- Opsi dari API akan ditambahkan di sini -->
                                </select>
                            </div>                            

                            {{-- <div class="col-md-6 form-group mb-3">
                                <label for="">Email Perguruan Tinggi <span style="color: red">*</span></label>
                                <textarea class="form-control" id="" rows="2" name=""  required></textarea>
                            </div> --}}
                            <div class="col-md-8">
                            <label for="org_alamat">Kontak Perguruan Tinggi</label>
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
                                <label for="org_status">Status Perguruan Tinggi<span style="color: red">*</span></label>
                                <select class="form-control mb-1" id="org_status" name="org_status" required>
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
                        <label for="">Logo Perguruan Tinggi<span style="color: red">*</span><small>jpg/jpeg/png</small></label>
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

        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="row ">
                            <div class="col-md-12 form-group mb-3">
                                <label for="badan-penyelenggara-select ">Badan Penyelenggara<span style="color: red">*</span></label>
                                <select id="badan-penyelenggara-select" class="js-example-basic-single" name="parent_organization_id" style="width: 100%" required>
                                    <option value="">Pilih</option>
                                    @foreach ($badanPenyelenggara_s as $item)
                                    <option value="{{ $item->org_defined_id }}">{{ $item->org_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row m-3">
                                <div class="col-md-5 d-flex justify-content-center align-items-center">
                                    <img class="img-fluid rounded mb-2" id="org_logo" data-url="{{ asset('storage/organization/logo/') }}"  alt="" />
                                </div>
                                <div class="col-md-5 d-flex justify-content-center align-items-center flex-column">
                                    <h2 id="org_nama_label" class="font-weight-bold text-center mb-0"></h2>
                                    <h6 id="org_status_label" class="font-weight-bold text-center mt-2"></h6>
                                </div>
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
                        {{-- your content should be here --}}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="akreditasi_sk">Nomor Surat Keputusan Akreditasi<span style="color: red">*</span></label>
                                <textarea class="form-control" id="akreditasi_sk" rows="2" name="akreditasi_sk"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akreditasi_tgl_awal"><small>Tanggal Mulai SK </small><span style="color: red">*</span></label>
                                <input class="form-control" style="height: 50px" id="akreditasi_tgl_awal" type="date" name="akreditasi_tgl_awal" required />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akreditasi_tgl_akhir"><small>Tanggal Berakhir SK </small><span style="color: red">*</span></label>
                                <input class="form-control" style="height: 50px" id="akreditasi_tgl_akhir" type="date" name="akreditasi_tgl_akhir" required />
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="akreditasi_status">Status Akreditasi Perguruan Tinggi<span style="color: red">*</span></label>
                                <select class="form-control mb-1" id="akreditasi_status" name="akreditasi_status" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Berakhir">Berakhir</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="">Lembaga Akreditasi<span style="color: red">*</span></label>
                                <select id="lembaga-akreditasi-select" style="width: 100%" class="js-example-basic-single" name="id_lembaga_akreditasi" required>
                                    <option value="">Pilih</option>
                                    @foreach ($lembaga_s as $item)
                                    <option value="{{ $item->id }}">{{ $item->lembaga_nama }}</option>
                                    @endforeach

                                </select>
                                <div class="row mt-3">
                                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                                        <img class="img-fluid rounded mb-2" id="lembaga_logo" data-url="{{ asset('storage/lembaga_akreditasi/') }}"  alt="" />
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                                        <h6 id="lembaga_nama" class="font-weight-bold text-center mb-0"></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="">Peringkat Akreditasi<span style="color: red">*</span></label>
                                <select id="peringkat-akreditasi-select" style="width: 100%" class="js-example-basic-single" name="id_peringkat_akreditasi" required>
                                    <option value="">Pilih</option>
                                    @foreach ($peringkat_s as $item)
                                    <option value="{{ $item->id }}">{{ $item->peringkat_nama }}</option>
                                    @endforeach

                                </select>
                                <div class="row mt-3">
                                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                                        <img class="img-fluid rounded mb-2" id="akreditasi_logo" data-url="{{ asset('storage/peringkat_akreditasi/') }}"  alt="" />
                                    </div>
                                    <div class="col-md-5 d-flex justify-content-center align-items-center flex-column">
                                        <h6 id="akreditasi_nama" class="font-weight-bold text-center mb-0"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <label for="">File SK Akreditas<span style="color: red">*</span><small>pdf</small></label>
                        <div class="card o-hidden mb-2">
                            <center>
                                <iframe align="center" frameborder='0' id="akreditasi_dokumen_preview" height="185" ></iframe>
                            </center>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input class="custom-file-input" id="form_inp_perti_akreditasi_dokumen" type="file" aria-describedby="inputGroupFileAddon01" name="akreditasi_dokumen" required/>
                                <label class="custom-file-label" for="perti_akreditasi_dokumen_inp_label" id="perti_akreditasi_dokumen_inp_label">Choose file</label>
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
        $(document).ready(function() {
            $('#badan-penyelenggara-select').select2();
        });

        $(document).ready(function() {
            $('#badan-penyelenggara-select').change(function() {
                let selectedValue = $(this).val();
                if(selectedValue == '') { // Jika nilai yang dipilih adalah kosong
                    // Reset nilai select
                    this.selectedIndex = 0; // Atur indeksnya ke 0 (pilihan pertama)
                    document.getElementById('org_logo').setAttribute('src', ''); // Mengosongkan sumber gambar
                    document.getElementById('org_nama').innerText = ''; // Mengosongkan teks
                    document.getElementById('org_status').innerText = ''; // Mengosongkan teks
                } else {
                    let orgLogoUrl = $('#org_logo').data('url');
                    $.ajax({
                        url: '{{ route("badan-penyelenggara.getBPById", ":value") }}'.replace(':value', selectedValue),
                        type: 'GET',
                        success: function(response) {
                            let logoUrl = orgLogoUrl + '/'+ response.data[0]['org_logo'];

                            $('#org_logo').attr('src', logoUrl);
                            $('#org_nama_label').text(response.data[0]['org_nama']);
                            $('#org_status_label').text(response.data[0]['org_status']);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#lembaga-akreditasi-select').select2();
        });

        $(document).ready(function() {
            $('#lembaga-akreditasi-select').change(function() {
                let selectedValue = $(this).val();
                if(selectedValue == ''){
                    this.selectedIndex = 0; // Atur indeksnya ke 0 (pilihan pertama)
                    $('#lembaga_logo').attr('src', '');
                    $('#lembaga_nama').text('');
                }else{
                    let lembagaLogoUrl = $('#lembaga_logo').data('url');
                    $.ajax({
                        url: '{{ route("lembaga-akreditasi.getById", ":value") }}'.replace(':value', selectedValue),
                        type: 'GET',
                        success: function(response) {
                            let logoUrl = lembagaLogoUrl + '/'+ response.data[0]['lembaga_logo'];

                            $('#lembaga_logo').attr('src', logoUrl);
                            $('#lembaga_nama').text(response.data[0]['lembaga_nama']);
                            $('#lembaga_status').text(response.data[0]['lembaga_status']);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#peringkat-akreditasi-select').select2();
        });

        $(document).ready(function() {
            $('#peringkat-akreditasi-select').change(function() {
                let selectedValue = $(this).val();
                if(selectedValue == ''){
                    this.selectedIndex = 0; // Atur indeksnya ke 0 (pilihan pertama)
                    $('#akreditasi_logo').attr('src', '');
                    $('#akreditasi_nama').text('');

                }else{
                    let peringkatAkreditasiLogoUrl = $('#akreditasi_logo').data('url');
                    $.ajax({
                        url: '{{ route("peringkat-akreditasi.getById", ":value") }}'.replace(':value', selectedValue),
                        type: 'GET',
                        success: function(response) {
                            let logoUrl = peringkatAkreditasiLogoUrl + '/'+ response.data[0]['peringkat_logo'];

                            $('#akreditasi_logo').attr('src', logoUrl);
                            $('#akreditasi_nama').text(response.data[0]['peringkat_nama']);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

    <script>

        $("#form_inp_perti_akreditasi_dokumen").change(function(){
            readURL(this, '#akreditasi_dokumen_preview');
        });

        // Ketika pengguna memilih file img, perbarui label
        $('#form_inp_perti_akreditasi_dokumen').change(function() {
            var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap

            // Memeriksa panjang nama file
            if (fileName.length > 20) {
                // Jika lebih dari 10 karakter, singkat nama file
                var shortenedFileName = fileName.substr(0, 15) + '...' + fileName.substr(-7);
                $('#perti_akreditasi_dokumen_inp_label').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
            } else {
                // Jika tidak, gunakan nama file lengkap
                $('#perti_akreditasi_dokumen_inp_label').text(fileName); // Mengatur label dengan nama file
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

    <script>
        function moveToNextInput(currentInput, nextInputId) {
            if (currentInput.value.length === currentInput.maxLength) {
                document.getElementById(nextInputId).focus();
            }
        }
    </script>
    


@endsection

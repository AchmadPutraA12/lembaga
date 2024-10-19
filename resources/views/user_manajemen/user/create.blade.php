@extends('layouts.master')

@section('page-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                    <form action="{{ route('user') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="name">Nama<span style="color: red">*</span></label>
                                <textarea class="form-control" id="name" rows="2" name="name"  required></textarea>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="email">Alamat Email<span style="color: red">*</span></label>
                                <textarea class="form-control" id="email" rows="2" name="email"  required></textarea>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="nip">Nomor Induk Pegawai<span style="color: red">*</span></label>
                                <input class="form-control" id="nip" name="nip"  placeholder="Enter phone" required />
                                 <!-- Input untuk password -->
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="role">Role<span style="color: red">*</span></label>
                                <select class="form-control" id="role" name="role" required>
                                    <option>Pilih</option>    
                                    @foreach ($roles as $role)
                                    <option>{{ $role->name }}</option>    
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="id_organization_type">Tipe Instansi<span style="color: red">*</span></label>
                                <select class="form-control" id="id_organization_type" name="id_organization_type" required>
                                    <option>Pilih</option>    
                                    @foreach ($organization_types as $organization_type)
                                    <option  value="{{ $organization_type->id }}" >{{ $organization_type->organization_type_name }}</option>    
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="col-md-6 form-group mb-3" id="id_organization_container" >
                                <label for="id_organization">Pilih Instansi<span style="color: red">*</span></label>
                                <select class="form-control" class="js-example-basic-single" id="id_organization" name="id_organization">
                                    <!-- Opsi tambahan akan ditambahkan di sini menggunakan AJAX -->
                                </select>
                            </div>

                            <div class="col-md-6 form-group mb-3 ">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img class="img-fluid rounded mb-2" id="org_logo" data-url="{{ asset('storage/organization/logo/') }}"  alt="" />
                                </div>
                                <h2 id="org_nama_label" class="font-weight-bold text-center mb-0"></h2>
                                <h6 id="org_status_label" class="font-weight-bold text-center mt-2"></h6>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="password">Password<span style="color: red">*</span></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <!-- Input untuk konfirmasi password -->
                            <div class="col-md-6 form-group mb-3">
                                <label for="password_confirmation">Password Confirmation<span style="color: red">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker1">Status<span style="color: red">*</span></label>
                                <select class="form-control" name="is_active" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                           
                            
                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function() {
        $('#id_organization_type').change(function() {
            var organizationTypeId = $(this).val();
            if (organizationTypeId) {
                $.ajax({
                    type: "GET",
                    url: "/organizationbyidorganizationtype/" + organizationTypeId, // Ubah URL ini sesuai dengan endpoint Anda
                    success: function(data) {
                        $('#id_organization').empty().append('<option value="">Pilih</option>');
                        $.each(data.data, function(index, item) {
                            $('#id_organization').append('<option value="' + item['org_defined_id'] + '">' + item['org_nama'] + '</option>');
                        });
                        $('#id_organization_container').show();
                         // Inisialisasi Select2 setelah menambahkan opsi baru
                        $('#id_organization').select2();
                    },                    
                    error: function(xhr) {
                        // Handle error yang terjadi
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#additionalOptionsContainer').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#id_organization').change(function() {
            var organizationId = $(this).val();
            if (organizationId) {
                $.ajax({
                    type: "GET",
                    url: "/organizationbydefinedid/" + organizationId, 
                    success: function(data) {
                        $('#org_logo').attr('src', $('#org_logo').data('url') + '/' + data.data[0]['org_logo']);
                        $('#org_nama_label').text(data.data[0]['org_nama']);
                        $('#org_status_label').text(data.data[0]['org_status']);
                    },
                    error: function(xhr) {
                        // Handle error yang terjadi
                        console.log(xhr.responseText);
                    }
                });
            } else {
                // Kosongkan elemen HTML jika tidak ada organisasi yang dipilih
                $('#org_logo').attr('src', '').hide(); // Kosongkan src dan sembunyikan gambar
                $('#org_nama_label').text(''); // Kosongkan teks dari nama label
                $('#org_status_label').text(''); // Kosongkan teks dari status label
            }
        });
});
</script>
@endsection
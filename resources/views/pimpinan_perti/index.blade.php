@extends('layouts.master')

@section('page-css')
    
@endsection

@section('main-content')

@php 
$pertiId = $_GET['id_perti'];
@endphp
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
        <div class="col-lg-12 mb-3">
            <div class="card card-body ul-border__bottom">
                <div class="accordion" id="accordionExample">
                    {{-- tambah jabatan baru --}}
                    @can('create_pimpinan_perguruan_tinggi')
                    <div class="collapse" id="collapse-text" data-parent="#accordionExample">
                        <div class="mt-3">
                            <div class="col-md-12">
                                <form action="{{ route('pimpinan-perti', ['id_perti' => $pertiId]) }}" method="post" enctype="multipart/form-data">                                    @csrf
                                    <div class="row">
                                        <div class=" col-md-7">
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="pimpinan_nama">Nama Pimpinan<span style="color: red">*</span></label>
                                                    <textarea class="form-control" id="pimpinan_nama" rows="2" name="pimpinan_nama"  required></textarea>
                                                </div>
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="id_jabatan">Jabatan<span style="color: red">*</span></label>
                                                    <select class="form-control mb-1" id="id_jabatan" name="id_jabatan" required>
                                                        <option value="">Pilih</option>
                                                        @foreach ($jabatan_s as $jabatan)
                                                            <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan_nama }}</option>    
                                                        @endforeach
                                                    </select>
                                                </div>
    
                                                <input type="hidden" readonly value="{{$perti->org_defined_id}}" name="id_organization">
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_status">Status<span style="color: red">*</span></label>
                                                    <select class="form-control mb-1" id="pimpinan_status" name="pimpinan_status" required>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Berakhir">Tidak Aktif</option>
                                                    </select>
                                                </div>
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_tgl_awal"><small>Tanggal Mulai</small><span style="color: red">*</span></label>
                                                    <input class="form-control" style="height: 50px" id="pimpinan_tgl_awal" type="date" name="pimpinan_tgl_awal" required />
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_tgl_akhir"><small>Tanggal Berakhir</small><span style="color: red">*</span></label>
                                                    <input class="form-control" style="height: 50px" id="pimpinan_tgl_akhir" type="date" name="pimpinan_tgl_akhir" required />
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class=" col-md-5">
                                            <div class="col-md-12 mb-4">
                                                <label for="">Surat Keputusan<span style="color: red">*</span></label>
                                                <div class="card o-hidden mb-2">
                                                    <iframe id="pimpinan_sk_preview" frameborder="0"></iframe>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="pimpinan_sk_dokumen" type="file" aria-describedby="inputGroupFileAddon01" name="pimpinan_sk_dokumen" required/>
                                                        <label class="custom-file-label" for="pimpinan_sk_dokumen" id="pimpinan_sk_dokumen_label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </div>
    
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>        
                            </div>
                        </div>
                    </div>
                    @endcan
    
                    {{-- edit pimpinan sesuai jabatan --}}
                    @can('create_pimpinan_perguruan_tinggi')
                    <div class="collapse" id="collapse-text-ganti-data" data-parent="#accordionExample">
                        <div class="mt-3">
                            <div class="col-md-12">
                                <form action="{{ route('pimpinan-perti', ['id_perti' => $pertiId]) }}" method="post" enctype="multipart/form-data">                                    @csrf
                                    <div class="row">
                                        <div class=" col-md-7">
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="pimpinan_nama">Nama Pimpinan<span style="color: red">*</span></label>
                                                    <textarea class="form-control" id="pimpinan_nama" rows="2" name="pimpinan_nama"  required></textarea>
                                                </div>
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="id_jabatan">Jabatan<span style="color: red">*</span></label>
                                                    <input type="hidden" name="id_jabatan" id="id_jabatan_inp" readonly>
                                                    <input class="form-control" type="text" name="jabatan_nama" id="jabatan_nama_inp" readonly>
                                                </div>
    
                                                <input type="hidden" readonly value="{{$perti->org_defined_id}}" name="id_organization">
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_status">Status<span style="color: red">*</span></label>
                                                    <select class="form-control mb-1" id="pimpinan_status" name="pimpinan_status" required>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Berakhir">Tidak Aktif</option>
                                                    </select>
                                                </div>
    
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_tgl_awal"><small>Tanggal Mulai</small><span style="color: red">*</span></label>
                                                    <input class="form-control" style="height: 50px" id="pimpinan_tgl_awal" type="date" name="pimpinan_tgl_awal" required />
                                                </div>
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="pimpinan_tgl_akhir"><small>Tanggal Berakhir</small><span style="color: red">*</span></label>
                                                    <input class="form-control" style="height: 50px" id="pimpinan_tgl_akhir" type="date" name="pimpinan_tgl_akhir" required />
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class=" col-md-5">
                                            <div class="col-md-12 mb-4">
                                                <label for="">Surat Keputusan<span style="color: red">*</span></label>
                                                <div class="card o-hidden mb-2">
                                                    <iframe id="pimpinan_sk_preview_ganti_data" frameborder="0"></iframe>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="pimpinan_sk_dokumen_ganti_data" type="file" aria-describedby="inputGroupFileAddon01" name="pimpinan_sk_dokumen" required/>
                                                        <label class="custom-file-label" for="pimpinan_sk_dokumen" id="pimpinan_sk_dokumen_label_ganti_data">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </div>
    
                                    </div>
        
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>        
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="col-md-7 mb-3">
                        <h4>Pimpinan Perguruan Tinggi</h4>

                        @can('create_pimpinan_perguruan_tinggi')
                        <button class="btn btn-primary ripple mb-3" data-toggle="collapse" data-target="#collapse-text" type="button">Tambah Jabatan +</button>    
                        @endcan
                                                
                        <div class="table-responsive">
                            <table class="table table-striped">
                                @foreach ($pimpinan_perti as $item)
                                <tr>
                                    <th scope="col">{{ $item->jabatan_nama }}</th>
                                    <th>:</th>
                                    <td>{{ $item->pimpinan_nama }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn bg-primary _r_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="_dot _r_block-dot bg-danger"></span>
                                                <span class="_dot _r_block-dot bg-warning"></span>
                                                <span class="_dot _r_block-dot bg-success"></span>
                                            </button>
                                            
                                            <div class="dropdown-menu" x-placement="bottom-start">
                                                @can('edit_pimpinan_perguruan_tinggi')
                                                <button class="dropdown-item" data-toggle="collapse" data-target="#collapse-text">Edit Data</button>    
                                                @endcan
                                                @can('create_pimpinan_perguruan_tinggi')
                                                <button class="dropdown-item ganti-data-btn" 
                                                        data-toggle="collapse" 
                                                        data-item-id_jabatan="{{ $item->id_jabatan }}" 
                                                        data-item-jabatan_nama="{{ $item->jabatan_nama }}" 
                                                        data-item-pimpinan_nama="{{ $item->pimpinan_nama }}" 
                                                        data-target="#collapse-text-ganti-data">
                                                            Ganti Data
                                                </button>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </table>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-bordered" id="main_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>TMT</th>
                                    <th>periode</th>
                                    <th>SK Pengangkatan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
    <script>
       
        $(document).ready(function () {
            const pertiId = '{{$pertiId}}';
            const table = $('#main_table').DataTable({
                dom: 'Bfrtip',
                processing:true,
                serverSide: true,
                ajax: '/pimpinan-perti/pimpinanpertibyidpertijson/' + pertiId,
                columns:[
                    { data: 'id', name: 'id', visible: false },
                    {
                        data: null,
                        visible: true,
                        orderable: false,
                        width: "5%",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'pimpinan_nama', name: 'pimpinan_nama' },
                    { data: 'jabatan_nama', name: 'jabatan_nama' },
                    { data: 'pimpinan_tgl_awal', name: 'pimpinan_tgl_awal'},
                    {
                        data: null,
                        name: 'periode',
                        render: function(data, type, row) {
                            // Mengambil tahun dari tanggal awal dan akhir
                            var tahunAwal = row.pimpinan_tgl_awal.split('-')[0];
                            var tahunAkhir = row.pimpinan_tgl_akhir.split('-')[0];
                            // Mengembalikan periode sebagai tahun awal - tahun akhir
                            return tahunAwal + ' - ' + tahunAkhir;
                        }
                    },
                    {
                        data: 'pimpinan_sk_dokumen',
                        name: 'pimpinan_sk_dokumen',
                        render: function(data, type, row) {
                            // Mengambil nama file dari URL sk dokumen
                            var fileName = data.split('/').pop();

                            // Mengembalikan HTML untuk menampilkan ikon preview dan download
                            return '<a href="/storage/organization/sk_pimpinan/' + fileName + '" class="btn btn-sm btn-primary" target="_blank"><i class="bi bi-eye"></i> </a> ' +
                                '<a download href="/storage/organization/sk_pimpinan/' + fileName + '" class="btn btn-sm btn-success"><i class="bi bi-download"></i> </a>';
                        }
                    }
                ],
                order: [
                    [3, 'asc'], // Urutkan berdasarkan kolom jabatan_nama secara menaik (asc)
                    [4, 'desc'] // Kemudian urutkan berdasarkan kolom pimpinan_tgl_awal secara menurun (desc)
                ],
            });
        });
    </script>

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
        
        $("#pimpinan_sk_dokumen").change(function(){
            readURL(this, '#pimpinan_sk_preview');
        });

        // Ketika pengguna memilih file img, perbarui label
        $('#pimpinan_sk_dokumen').change(function() {
            var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap
            // Memeriksa panjang nama file
            if (fileName.length > 30) {
                // Jika lebih dari 10 karakter, singkat nama file
                var shortenedFileName = fileName.substr(0, 20) + '......' + fileName.substr(-7);
                    $('#pimpinan_sk_dokumen_label').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
            } else {
                // Jika tidak, gunakan nama file lengkap
                $('#pimpinan_sk_dokumen_label').text(fileName); // Mengatur label dengan nama file
            }
        });
    </script>

    <script>
        
        $("#pimpinan_sk_dokumen_ganti_data").change(function(){
            readURL(this, '#pimpinan_sk_preview_ganti_data');
        });

        // Ketika pengguna memilih file img, perbarui label
        $('#pimpinan_sk_dokumen_ganti_data').change(function() {
            var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap
            // Memeriksa panjang nama file
            if (fileName.length > 30) {
                // Jika lebih dari 10 karakter, singkat nama file
                var shortenedFileName = fileName.substr(0, 20) + '......' + fileName.substr(-7);
                    $('#pimpinan_sk_dokumen_label_ganti_data').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
            } else {
                // Jika tidak, gunakan nama file lengkap
                $('#pimpinan_sk_dokumen_label_ganti_data').text(fileName); // Mengatur label dengan nama file
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.ganti-data-btn').click(function() {
                let itemIdJabatan = $(this).data('item-id_jabatan');
                let itemJabatanNama = $(this).data('item-jabatan_nama');
                let itemPimpinanNama = $(this).data('item-pimpinan_nama');
                
                $('#id_jabatan_inp').val(itemIdJabatan);
                $('#jabatan_nama_inp').val(itemJabatanNama);
            });
        });
    </script>

        
@endsection
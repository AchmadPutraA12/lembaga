@extends('layouts.master')

@section('page-css')
@endsection

@section('main-content')
    @php
    $pertiId = $perti->org_defined_id;
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
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div>
                            <h4>Identitas Perguruan Tinggi</h4>
                            <div class="row">
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <img class="img-fluid rounded mb-2"
                                        src="{{ asset('storage/organization/logo/' . $perti->org_logo) }}" alt="" />
                                </div>
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <h2 class="font-weight-bold text-center">{{ $perti->org_nama }}</h2>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <img class="img-fluid rounded mb-2"
                                        src="{{ asset('storage/peringkat_akreditasi/' . $perti->peringkat_logo) }}"
                                        alt="" />
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h4>Informasi Perguruan Tinggi</h4>
                                    @can('edit_data_perguruan_tinggi')
                                        <div class="button-group mb-3">
                                            <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                            <button type="button" class="btn btn-sm btn-secondary">Detail</button>
                                        </div>
                                    @endcan
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th scope="col">SK Pendirian</th>
                                                <th>:</th>
                                                <td>{{ $perti->akta_nomor }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Tanggal SK Pendirian</th>
                                                <th>:</th>
                                                <td>{{ $perti->akta_tgl_awal }} s/d {{ $perti->akta_tgl_akhir }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Kota</th>
                                                <th>:</th>
                                                <td>{{ $perti->org_kota }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Alamat</th>
                                                <th>:</th>
                                                <td>{{ $perti->org_alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Email</th>
                                                <th>:</th>
                                                <td>{{ $perti->org_email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Telepon</th>
                                                <th>:</th>
                                                <td>{{ $perti->org_telp }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Website</th>
                                                <th>:</th>
                                                <td>{{ $perti->org_website }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Kepemilikan</th>
                                                <th>:</th>
                                                <td>
                                                    <img width="50px" height="50px"
                                                        src=" {{ asset('storage/organization/logo/' . $perti->parent_logo) }} "
                                                        alt="">
                                                    <br>
                                                    {{ $perti->parent_nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Akreditasi</th>
                                                <th>:</th>
                                                <td>{{ $perti->peringkat_nama }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">SK Akreditasi</th>
                                                <th>:</th>
                                                <td>{{ $perti->akreditasi_sk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Tanggal SK Akreditasi</th>
                                                <th>:</th>
                                                <td>{{ $perti->akreditasi_tgl_awal }} s/d
                                                    {{ $perti->akreditasi_tgl_akhir }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Lembaga Akreditasi</th>
                                                <th>:</th>
                                                <td>
                                                    <img width="50px" height="50px"
                                                        src=" {{ asset('storage/lembaga_akreditasi/' . $perti->lembaga_logo) }} "
                                                        alt="">
                                                    <br>
                                                    {{ $perti->lembaga_nama }}
                                                </td>
                                            </tr>

                                        </table>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Pimpinan Perguruan Tinggi</h4>
                                    @can('access_pimpinan_perguruan_tinggi')
                                    <div class="button-group mb-3">
                                        <a href="{{ route('pimpinan-perti', ['id_perti' => $perti->org_defined_id]) }}"><button type="button" class="btn btn-sm btn-secondary">Detail</button></a>
                                    </div>
                                    @endcan

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            @foreach ($pimpinan_perti as $item)
                                            <tr>
                                                <th scope="col">{{ $item->jabatan_nama }}</th>
                                                <th>:</th>
                                                <td>{{ $item->pimpinan_nama }}</td>
                                            </tr>
                                            @endforeach
                                           
                                        </table>
                                    </div>

                                </div>
                            </div>
                            @can('access_data_program_studi')
                            <hr />
                            <h4>Daftar Program Studi </h4>
                            <p class="mb-4">Daftar program Studi di bawah {{ $perti->org_nama }}</p>
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered" id="main_table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>No</th>
                                            <th>Kode PS</th>
                                            <th>Nama Program Studi</th>
                                            <th>Jenjang</th>
                                            <th>Status</th>
                                            <th>Nomor SK</th>
                                            <th>Peringkat Akreditasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>                                
                            @endcan

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    {{-- datatable button --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            const pertiId = '{{$pertiId}}';

            @can('create_data_program_studi')
            const addButton = {
                text: '+ Add New',
                attr: {
                    id: 'add-new-program-studi',
                    class: 'btn btn-primary',
                },
            }
            @endcan

            const tableButtons = [
                @can('create_data_program_studi')
                    addButton
                @endcan
            ]
            const table = $('#main_table').DataTable({
                dom: 'Bfrtip',
                buttons: tableButtons,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("program-studi.getByIdperti", ["id_perti" => ":pertiId"]) }}'.replace(':pertiId', pertiId),                },
                columns: [{
                        data: 'prodi_defined_id',
                        name: 'prodi_defined_id',
                        visible: false
                    },
                    {
                        data: null,
                        visible: true,
                        orderable: false,
                        width: "5%",
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'prodi_kode',
                        name: 'prodi_kode'
                    },
                    {
                        data: 'prodi_nama',
                        name: 'prodi_nama'
                    },
                    {
                        data: 'prodi_jenjang',
                        name: 'prodi_jenjang'
                    },
                    {
                        data: 'prodi_active_status',
                        name: 'prodi_active_status'
                    },
                    {
                        data: 'akreditasi_sk',
                        name: 'akreditasi_sk'
                    },
                    {
                        data: 'peringkat_nama',
                        name: 'peringkat_nama'
                    },
                    {
                        data: 'action',
                        name: 'Action',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            var detailUrl =
                                "{{ route('program-studi.show', ':prodi_defined_id') }}".replace(
                                    ':prodi_defined_id', row.prodi_defined_id);
                            var editUrl = "{{ route('program-studi.edit', ':prodi_defined_id') }}"
                                .replace(':prodi_defined_id', row.prodi_defined_id);

                            return `
                        <div class="btn-group dropleft">
                            <button class="btn bg-primary _r_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="_dot _r_block-dot bg-danger"></span>
                                <span class="_dot _r_block-dot bg-warning"></span>
                                <span class="_dot _r_block-dot bg-success"></span>
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                                <a class="dropdown-item" href="${detailUrl}">Detail</a>
                                <a class="dropdown-item" href="${editUrl}">Edit</a>
                            </div>
                        </div>
                    `;
                        }
                    }
                ],
                order: [
                    [0, 'asc']
                ] // Order by the first column ('id') in ascending order
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#add-new-program-studi').click(function() {
                var url = '{{ route("program-studi.create", ['id_perti' => $pertiId]) }}';
                window.location.href = url;
            });
        });
    </script>
@endsection

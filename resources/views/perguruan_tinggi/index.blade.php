@extends('layouts.master')

@section('page-css')
@endsection

@section('main-content')
    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Daftar Perguruan Tinggi</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        {{-- your conten should be here --}}
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="main_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Akronim</th>
                                        <th>Nama Perguruan Tinggi</th>
                                        <th>Kota</th>
                                        <th>Status</th>
                                        <th>Akreditasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end of main-content -->
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

            let ajaxRoute = '';
            @if (auth()->user()->can('view_all_perguruan_tinggi'))
                ajaxRoute = '{{ route("perguruan-tinggi.ptjson") }}';
            @elseif (auth()->user()->can('view_restrict_perguruan_tinggi'))
                @if (auth()->user()->id_organization_type == 1)
                    ajaxRoute = '{{ route("perguruan-tinggi.ptjson") }}';
                @elseif (auth()->user()->id_organization_type == 2)
                    ajaxRoute = '{{ route("perguruan-tinggi.getPTByIdBP", ["id_bp" => auth()->user()->id_organization ]) }}';                
                @elseif (auth()->user()->id_organization_type == 3)
                    ajaxRoute = '{{ route("perguruan-tinggi.getPTById", ["id" => auth()->user()->id_organization ]) }}';               
                @endif
            @else
                ajaxRoute = '{{ route("perguruan-tinggi.default") }}';
                // ajaxRoute = '';
            @endif

            // console.log(ajaxRoute);

            @can('create_data_perguruan_tinggi')
                const addButton = {
                    text: '+ Add New',
                    attr: {
                        id: 'add-new-pt',
                        class: 'btn btn-primary',
                    }
                };
            @endcan

            const tableButtons = [
                @can('create_data_perguruan_tinggi')
                    addButton,
                @endcan
            ];

            const table = $('#main_table').DataTable({
                dom: 'Bfrtip',
                buttons: tableButtons,
                processing: true,
                serverSide: true,
                ajax:  ajaxRoute,
                columns: [{
                        data: 'org_defined_id',
                        name: 'org_defined_id',
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
                        data: 'org_kode',
                        name: 'org_kode'
                    },
                    {
                        data: 'org_nama_singkat',
                        name: 'org_nama_singkat'
                    },
                    {
                        data: 'org_nama',
                        name: 'org_nama'
                    },
                    {
                        data: 'org_kota',
                        name: 'org_kota'
                    },
                    {
                        data: 'org_status',
                        name: 'org_status'
                    },
                    {
                        data: 'peringkat_nama',
                        name: 'peringkat_nama'
                    },
                    {
                        data: 'action',
                        name: 'Action',
                        searchable: 'false',
                        orderable: false,
                        render: function(data, type, row, meta) {
                            var detailUrl =
                                "{{ route('perguruan-tinggi.show', ':org_defined_id') }}".replace(
                                    ':org_defined_id', row.org_defined_id);
                            var editUrl =
                                "{{ route('perguruan-tinggi.edit', ':org_defined_id') }}".replace(
                                    ':org_defined_id', row.org_defined_id);

                            return `
                                <div class="btn-group dropleft">
                                    <button class="btn bg-primary _r_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="_dot _r_block-dot bg-danger"></span>
                                        <span class="_dot _r_block-dot bg-warning"></span>
                                        <span class="_dot _r_block-dot bg-success"></span>
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start">
                                        @can('show_data_perguruan_tinggi')
                                        <a class="dropdown-item" href="${detailUrl}">Detail</a>
                                        @endcan
                                        @can('edit_data_perguruan_tinggi')
                                        <a class="dropdown-item" href="${editUrl}">Edit</a>
                                        @endcan
                                    </div>
                                </div>
                            `;
                        }
                    },
                ],
                order: [
                    [0, 'asc']
                ] // Order by the first column ('id') in ascending order
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#add-new-pt').click(function() {
                window.location.href = '{{ route('perguruan-tinggi.create') }}';
            });
        });
    </script>
@endsection

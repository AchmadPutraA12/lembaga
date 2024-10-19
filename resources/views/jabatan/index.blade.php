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
    @can('create_data_jabatan')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card card-body ul-border__bottom">
                <div class="collapse" id="collapse-text">
                    <div class="mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('jabatan-pimpinan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class=" col-md-5">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="jabatan_nama">Nama Jabatan<span style="color: red">*</span></label>
                                                <textarea class="form-control" id="jabatan_nama" rows="2" name="jabatan_nama"  required></textarea>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="jabatan_active_status">Status<span style="color: red">*</span></label>
                                                <select class="form-control mb-1" id="jabatan_active_status" name="jabatan_active_status">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                </select>
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
            </div>
        </div>
    </div>
    @endcan

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
                                    <th>Nama Jabatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {

        @can('create_data_jabatan')
            const addButton = {
                text:'+ Add New',
                    attr:{
                        id:'add-new-ja',
                        class:'btn btn-primary',
                    }
            }
        @endcan

        const tableButtons = [
            @can('create_data_jabatan')
                addButton,
            @endcan
        ];


        const table = $('#main_table').DataTable({
            dom: 'Bfrtip',
            buttons: tableButtons,
            processing:true,
            serverSide: true,
            ajax: '/jabatan-pimpinan/jabatanjson',
            columns: [
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
                { data: 'jabatan_nama', name: 'jabatan_nama'},
                { data: 'jabatan_active_status', name: 'jabatan_active_status'},
                
                { 
                    data: 'action', 
                    name: 'Action',
                    searchable:'false',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var editUrl = "{{ route('jabatan-pimpinan.edit', ':id') }}".replace(':id', row.id);

                        return `
                            <div class="btn-group dropleft">
                                <button class="btn bg-primary _r_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="_dot _r_block-dot bg-danger"></span>
                                    <span class="_dot _r_block-dot bg-warning"></span>
                                    <span class="_dot _r_block-dot bg-success"></span>
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    @can('edit_data_jabatan')
                                    <a class="dropdown-item" href="${editUrl}">Edit</a>
                                    @endcan
                                </div>
                            </div>
                        `;
                    }
                },


                
            ],
            order: [[0, 'asc']] // Order by the forst column ('id') in ascending order
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#add-new-ja').click(function() {
             // Tambahkan atribut data-toggle dan data-target
             $(this).attr('data-toggle', 'collapse');
            $(this).attr('data-target', '#collapse-text');
        });
    });
</script>

@endsection
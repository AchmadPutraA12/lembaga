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
    @can('create_data_peringkat_akreditasi')
    <div class="row">
        <div class="col-lg-12 mb-3">
            <div class="card card-body ul-border__bottom">
                <div class="collapse" id="collapse-text">
                    <div class="mt-3">
                        <div class="col-md-12">
                            <form action="{{ route('peringkat-akreditasi') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-5 form-group">
                                        <label for="peringkat_nama">Peringkat Akreditasi</label>
                                        <input class="form-control" id="peringkat_nama" name="peringkat_nama" type="text" placeholder="Enter your name" required />
                                        <br>
                                        <label for="bp_status">Status Badan Penyelenggara<span style="color: red">*</span></label>
                                        <select class="form-control mb-1" id="bp_status" name="peringkat_akreditasi_active_status">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Logo Peringkat<span style="color: red">*</span></label>
                                        <div class="card o-hidden mb-2">
                                            <iframe id="blah" frameborder="0"></iframe>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="custom-file-input" id="peringkat_logo" type="file" aria-describedby="inputGroupFileAddon01" name="peringkat_logo" accept="image/png, image/jpeg, image/jpg" required/>
                                                <label class="custom-file-label" for="peringkat_logo" id="imgLabelPeringkatLogo">Choose file</label>
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
                                    <th>Peringkat</th>
                                    <th>Logo</th>
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
        const assetUrl = "{{ asset('storage/peringkat_akreditasi') }}";
        
        @can('create_data_peringkat_akreditasi')
            const addButton = {
                text:'+ Add New',
                attr:{
                    id:'add-new-pa',
                    class:'btn btn-primary',
                }
            };
        @endcan

        const tableButtons = [
            @can('create_data_peringkat_akreditasi')
                addButton,
            @endcan
        ];

        const table = $('#main_table').DataTable({
            dom: 'Bfrtip',
            buttons: tableButtons,
            processing:true,
            serverSide: true,
            ajax: '/peringkat-akreditasi/peringkatakreditasijson',
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
                { data: 'peringkat_nama', name: 'peringkat_nama'},
                {
                data: 'peringkat_logo',
                name: 'peringkat_logo',
                render: function(data) {
                    return '<img src="' + assetUrl + '/' +data + '" width="50" height="50">';
                }
            },
                { 
                    data: 'action', 
                    name: 'Action',
                    searchable:'false',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var editUrl = "{{ route('peringkat-akreditasi.edit', ':id') }}".replace(':id', row.id);

                        return `
                            <div class="btn-group dropleft">
                                <button class="btn bg-primary _r_btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="_dot _r_block-dot bg-danger"></span>
                                    <span class="_dot _r_block-dot bg-warning"></span>
                                    <span class="_dot _r_block-dot bg-success"></span>
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    @can('edit_data_peringkat_akreditasi')
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
        $('#add-new-pa').click(function() {
             // Tambahkan atribut data-toggle dan data-target
            $(this).attr('data-toggle', 'collapse');
            $(this).attr('data-target', '#collapse-text');
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
     // Event listener untuk halaman dimuat ulang
</script>


<script>
    
    $("#peringkat_logo").change(function(){
        readURL(this, '#blah');
    });

    // // Ketika pengguna memilih file img, perbarui label
    $('#peringkat_logo').change(function() {
        var fileName = $(this).val().split('\\').pop(); // Mengambil nama file dari path lengkap
        // Memeriksa panjang nama file
        if (fileName.length > 30) {
            // Jika lebih dari 10 karakter, singkat nama file
            var shortenedFileName = fileName.substr(0, 20) + '......' + fileName.substr(-7);
                $('#imgLabelPeringkatLogo').text(shortenedFileName); // Mengatur label dengan nama file yang disingkat
        } else {
            // Jika tidak, gunakan nama file lengkap
            $('#imgLabelPeringkatLogo').text(fileName); // Mengatur label dengan nama file
        }

    });
</script>

@endsection
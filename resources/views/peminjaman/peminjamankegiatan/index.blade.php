@extends('layouts.master')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Peminjaman</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Peminjaman Kegiatan
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                    <button class="btn btn-primary pull-right btn-flat" onclick="cetak()"><i id="hiden" class="fa fa-print"></i> Cetak</button>

                </div>
                <div class="panel-body" id="form-panel">
                    @include('peminjaman.peminjamankegiatan.form')
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-peminjaman">
                            <thead>
                                <tr>
                                    <th>No.Berkas</th>
                                    <th></th>
                                    <th>Kegiatan</th>
                                    <th>Peminjaman Via</th>
                                    <th>Tanggal Pinjam</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('peminjaman.peminjamankegiatan.modaldetail')


@push('scripts')
    <script>
        $("#form-panel").hide();
        
       

        $(function () {
            $('#form-peminjamanproses form').validator().on('submit', function (e) {

            });
        });


        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-peminjaman').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/peminjamankegiatan') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'nama',name:'nama'},
                    {data: 'kegiatan.nama_kegiatan',name:'kegiatan.nama_kegiatan'},
                    {data: 'via',name:'via'},
                    {data: 'tanggal_pinjam',name:'tanggal_pinjam'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],  
                order: [[ 4, 'desc' ]],
                language: {
                    lengthMenu: "Menampilkan _MENU_",
                    zeroRecords: "Data tidak ada",
                    info: "Halaman _PAGE_ dari _PAGES_ Halaman",
                    infoEmpty: "-",
                    infoFiltered: "(dari _MAX_ total data)",
                    loadingRecords: "Silahkan Tunggu...",
                    processing:     "Dalam Proses...",
                    search:         "Cari:",
                    paginate: {
                        first:      "Awal",
                        last:       "Akhir",
                        next:       "Selanjutnya",
                        previous:   "Kembali"
                    },
                },
                
                aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
                {{-- iDisplayLength: 15 --}}
            }),
           
            yadcf.init(Table, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Peminjam"
                },
            ]);
            
            {{--  Table.on( 'order.dt search.dt', function () {
                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();  --}}
           
        });
        
        function cetak() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $('#nama').val('');
            $('#nik').val('');
            $('#unit_kerja').val('');
        }

        $(document).on('click', "#cek", function (e) {
            e.preventDefault();
            var id = $(this).data('id')
            var status = $(this).data('value');
            swal({
                title: 'Apakah anda yakin ingin mengembalikan semua berkas?',
                text: "Konfirmasi Pengembalian Berkas",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Kembalikan',
                cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
            }).then(function(){  
                $.ajax({
                    url: "{{ url('peminjamankegiatancek')}}",
                    type: "GET",
                    data: {status:status, id:id},
                        success: function (data) {
                        $('#data-peminjaman').dataTable().api().ajax.reload();
                        $('div.flash-message').html(data);
                    },
                        error: function () {
                        alert('Oops! error!');
                    }
                });
            });
        });
        

    </script>

@endpush
@endsection
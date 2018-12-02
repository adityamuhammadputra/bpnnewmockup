@extends('layouts.master')

@section('content')
<style>
        .modal-title{
            color: white;
        }
</style>
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center";>
                    <b>Peminjaman Kontrol</b>
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-master">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="10%"></th>
                                    <th width="10%">Via</th>
                                    <th>Tanggal Pinjam</th>
                                    <th width="10%"></th>
                                    <th width="10%">Jenis Hak</th>
                                    <th width="10%"></th> 
                                    <th width="10%"></th> 
                                    <th width="10%">Keterangan</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Penyerahan Kegiatan</th>
                                    <th>Tanggal Kembali</th>
                                    <th width="10%">Status</th>
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#sidebar-collapse').hide();
            $('#form-panel').hide();
        });
        
            

        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-master').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/kontrol') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'peminjamanheader.nama',name:'peminjamanheader.nama'},
                    {data: 'peminjamanheader.via',name:'peminjamanheader.via'},
                    {data: 'peminjamanheader.tanggal_pinjam',name:'peminjamanheader.tanggal_pinjam'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'jenis_hak',name:'jenis_hak'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    // {data: 'no_warkah',name:'no_warkah'},
                    // {data: 'no_su',name:'no_su'},
                    {data: 'peminjamanheader.kegiatan.nama_kegiatan',name:'peminjamanheader.kegiatan.nama_kegiatan'},
                    {data: 'peminjamanheader.tanggal_kembali',name:'peminjamanheader.tanggal_kembali'},
                    {data: 'tanggal_kegiatan',name:'tanggal_kegiatan'},
                    {data: 'tanggal_kembali',name:'tanggal_kembali'},
                    {   
                        data: 'status_detail',
                        name:'status_detail',
                        "render": function ( data, type, row ){
                            if(data === 0){
                                return '<span class="label label-danger">Di Proses</span>';
                            } else if(data === '1'){
                                return '<span class="label label-primary">Di Kegiatan</span>';
                            } else if(data === '2'){
                                return '<span class="label label-warning">Di Tunggakan</span>';
                            }
                            else if(data === '3'){
                                return '<span class="label label-default">Di Pinjam</span>';
                            }
                            else{
                                return '<span class="label label-success">Di Kembalikan</span>';
                            }
                            
                        }
                    },
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false ,
                    targets: 0
                } ], 
                order: [[ 10, 'asc' ]],
                language: {
                    lengthMenu: "Menampilkan _MENU_",
                    zeroRecords: "Data yang anda cari tidak ada, Silahkan masukan keyword lainnya",
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
                iDisplayLength: 25
            })
        
             yadcf.init(Table, [
            {
                column_number: 1,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Nama"
            },
            {
                column_number: 4,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "No Hak"
            },
            {
                column_number: 6,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Desa "
            },
            {
                column_number: 7,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Kecamatan"
            },
        ]);
         
             Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-master').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );

                setInterval( function () {
                Table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 3000 );
        });
        
    </script>

@endpush
@endsection
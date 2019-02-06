@extends('layouts.master')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Penyerahan</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    History Penyerahan
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                    <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i id="hiden" class="fa fa-minus-circle"></i> Form Cetak</button>
                
                </div>
                <div class="panel-body" id="form-panel">
                    @include('penyerahan.penyerahanhistory.form')
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-penyerahan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Kode Box</th>
                                    <th></th>
                                    <th>Sms Notifikasi</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Foto</th>
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
        
        
         
        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-penyerahan').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/penyerahanhistory') }}",
                type: "POST",
                columns: [
                   {data: 'id',name:'id'},
                    {data: 'no_berkas',name:'no_berkas'},
                    {data: 'kd_box',name:'kd_box'},
                    {data: 'nama1',name:'nama1'},
                    {data: 'email',name:'email'},
                    {data: 'kegiatan.nama_kegiatan',name:'kegiatan.nama_kegiatan'},
                    {data: 'tanggal1',name:'tanggal1'},
                    {
                        data: 'foto',
                        name:'foto',
                        "render": function ( data, type, row ){
                            if(data === 'app/public/default.png'){
                                return '<span class="label label-warning">Belum Diserahkan</span>';
                            }
                            else{
                                return '<span class="label label-success">Sudah Diserahkan</span>';
                            }
                        }
                    },
                    {data: 'fotos', name: 'fotos'}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],  
                order: [[ 6, 'desc' ]],
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
                    filter_default_label: "No Berkas"
                },
                 {
                    column_number: 3,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Pemohon"
                },
            ]);
            
             Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-penyerahan').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
           
        });
        


    </script>

@endpush
@endsection
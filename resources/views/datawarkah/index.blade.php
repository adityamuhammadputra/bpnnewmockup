@extends('layouts.master')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-sticky-note"></em>
            </a></li>
            <li class="active">Data Warkah</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Master Data Warkah 
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <button class="btn btn-primary pull-right btn-flat"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-warkah">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="10%"></th>
                                    <th>No Box</th>
                                    <th></th>
                                    <th>Lokasi Ruang</th>
                                    <th>Baris</th>
                                    <th>Posisi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    {{--  </div>  --}}
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-warkah').DataTable({

                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.warkah') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'no_warkah',name:'no_warkah'},
                    {data: 'no_box',name:'no_box'},
                    {data: 'tahun',name:'tahun'},
                    {data: 'lokasi_ruang',name:'lokasi_ruang'},
                    {data: 'baris',name:'baris'},
                    {data: 'posisi',name:'posisi'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                {{--  columnDefs: [ {
                    searchable: false,
                    orderable: false,
                    targets: 0
                } ],  --}}
                order: [[ 0, 'asc' ]],
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
                }
            })
        
            yadcf.init(Table, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nomor Warkah"

                },
                {
                    column_number: 3,
                    filter_type: "text",
                    filter_default_label: "Tahun Warkah"
                }
            
                
            ]);
            {{--  Table.on( 'order.dt search.dt', function () {
                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();  --}}
        });
    </script>

@endpush
@endsection
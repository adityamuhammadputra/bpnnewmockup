@extends('layouts.master')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-sticky-note"></em>
            </a></li>
            <li class="active">Data PTSL</li>
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
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-ptsl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Berkas</th>
                                    <th>No Hak</th>
                                    <th>No 208</th>
                                    <th>No Surat Ukur</th>
                                    <th></th>
                                    <th>Nama Pemegang</th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
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
            Table = $('#data-ptsl').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.ptsl') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'no_berkas',name:'no_berkas'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'no_208',name:'no_208'},
                    {data: 'no_su',name:'no_su'},
                    {data: 'tahun',name:'tahun'},
                    {data: 'pemegang',name:'pemegang'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
               
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
                },
                aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            })
            yadcf.init(Table, [
                {
                    filter_default_label: "Tahun Warkah",
                    column_number: 5,
                    column_data_type: "html",
                    html_data_type: "text",
                    filter_default_label: "Tahun"
                }
            ]);
        
            
            
        });
    </script>

@endpush
@endsection
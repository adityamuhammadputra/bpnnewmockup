@extends('layouts.master')

@section('content')
<style>
        .modal-title{
            color: white;
        }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-check-square-o"></em>
            </a></li>
            <li class="active">Data Peminjaman</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informasi Peminjaman Buku Tanah
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    </div>
                    <div class="panel-body" id="form-panel">
                        @include('bukutanah.form')
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-peminjaman">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pemohon</th>
                                    <th>No Hak</th>
                                    <th>Jenis Hak</th>
                                    <th>Tahun</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Tanggal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
                Table = $('#data-peminjaman').DataTable({
                    colReorder: true,
                    processing: true,
                    serverSide:true,
                    ajax:"{{ url('api/peminjamanloket') }}",
                    columns: [
                        {data: 'id',name:'id'},
                        {data: 'nik',name:'nik'},
                        {data: 'nama',name:'nama'},
                        {data: 'no_hak',name:'no_hak'},
                        {data: 'jenis_hak',name:'jenis_hak'},
                        {data: 'tahun',name:'tahun'},
                        {data: 'keperluan',name:'peminjamandetail.keperluan'},
                        {data: 'desa',name:'desa'},
                        {data: 'tanggal',name:'tanggal'},
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
                    },
                    aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
                    {{-- iDisplayLength: 15 --}}
                })
            
                
            });


        $('#form-panel').hide();

        function addData(){
            $('#form-panel').slideToggle();
        }
        
        function btnCancel(){
            $('#form-panel').slideUp();
        }


    </script>

@endpush
@endsection
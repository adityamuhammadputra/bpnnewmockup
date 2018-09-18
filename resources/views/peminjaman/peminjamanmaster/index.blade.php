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
            <li class="active">Stock Opname Fisik Buku Tanah</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Stock Opname Fisik Buku Tanah
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                </div>
                <div class="panel-body" id="form-panel">
                    @include('peminjaman.peminjamanmaster.form')
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-master">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th></th>
                                    <th>Jenis Hak</th>
                                    <th></th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Keterangan</th>
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

@push('scripts')
    <script>
        $('#form-panel').hide();

        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-master').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.peminjaman.master') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'idbukutanah',name:'idbukutanah'},
                    {data: 'jenis_hak',name:'jenis_hak'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    {   
                        data: 'status',
                        name:'status',
                        "render": function ( data, type, row ){
                            if(data === '1'){
                                return '<span class="label label-success">Berkas Ada</span>';
                            }
                            else{
                                return '<span class="label label-warning">Berkas Tidak Ada</span>';
                            }
                            
                        }
                    },
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false ,
                    targets: 0
                } ], 
                order: [[ 1, 'asc' ]],
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
        
            yadcf.init(Table, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "ID Buku Tanah"
                },
                {
                    column_number: 3,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No Hak"
                },
            ]);
            {{--  Table.on( 'order.dt search.dt', function () {
                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();  --}}
        });

        function addData() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#form-peminjamanmaster form')[0].reset();
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $("#form-peminjamanmaster").load(" #form-peminjamanmaster");    
            $('#form-peminjamanmaster form')[0].reset();
            $("#form-panel").slideUp();
        }

        

        $(document).on('click', "#cek", function (e) {
            e.preventDefault();
            var id = $(this).data('id')
            var status = $(this).data('value');
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
              url: "{{ url('peminjamanmaster/cek')}}",
              type: "GET",
              data: {status:status , id:id},
                success: function (data) {
                  $('#data-master').dataTable().api().ajax.reload();
                  $('div.flash-message').html(data);
                },
                error: function () {
                  alert('Oops! error!');
                }
              });
          });
       
        
        
    </script>

@endpush
@endsection
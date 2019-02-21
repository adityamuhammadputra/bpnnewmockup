@extends('layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Users</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User Permission
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                    <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i id="hiden" class="fa fa-minus-circle"></i> Hide Form</button>

                </div>
               
                <div class="panel-body" id="form-panel">
                    @include('user.permission.form')
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-role">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Permission Id</th>
                                    <th></th>
                                    <th>Gueard Name</th>
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
         var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-role').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/userpermission') }}",
                columns: [
                    {data: null },
                    {data: 'id',name:'id'},
                    {data: 'name',name:'name'},
                    {data: 'guard_name',name:'guard_name'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],  
                order: [[ 2, 'asc' ]],
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
                iDisplayLength: 25
            }),
           
            yadcf.init(Table, [
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Permission"
                },
                 
            ]);
            
             Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-role').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
           
        }); 


        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Apakah Anda yakin Menghapus Data?',
                text: "Konfirmasi Penghapusan Data",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Hapus ini',
                cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
            }).then(function(){                
                $.ajax({
                    url: "{{ url('userpermission')}}/" + id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-role').dataTable().api().ajax.reload();
                        $('#form form')[0].reset();
                        $('div.flash-message').html(data);
                    },
                    error: function () {
                        swal({
                            title:'opss..',
                            text: 'Terjadi Error, Silahkan Hubungi Pengembang',
                            type:'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }
    </script>
@endpush
@endsection
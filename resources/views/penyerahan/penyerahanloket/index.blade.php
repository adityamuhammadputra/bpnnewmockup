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
                    Loket Penyerahan
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
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
                                    <th>Tanggal</th>
                                    <th>Status Cetak</th>
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
                    url: "{{ url('penyerahanloket')}}/"+id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-penyerahan').dataTable().api().ajax.reload();
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

        $(function () {
            $('#form-penyerahanproses form').validator().on('submit', function (e) {

            });
        });


        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-penyerahan').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/penyerahanloket') }}",
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
                                return '<span class="label label-warning">Belum Dicetak</span>';
                            }
                            else{
                                return '<span class="label label-success">Sudah Dicetak</span>';
                            }
                        }
                    },
                    {data: 'action',name:'action',orderable:false, searchable:false}
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
                    column_number: 3,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Pemohon"
                },
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No Berkas"
                },
            ]);
            
             Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-penyerahan').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
           
        });
        
        function addData() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $('#nama').val('');
            $('#nik').val('');
            $('#unit_kerja').val('');
        }
        
        function cetak(url) {
            var link = "cetak/penyerahanloket/"+url;
             swal({
                title: 'Konfirmasi Cetak Data',
                text: "Mencatak data artinya mencetak dan validasi, Apakah anda yakin ?",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Cetak data ini',
                cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
            }).then(function(){  
                window.open(link,'_blank');
                window.focus();
                location.reload();
                
            })
        }

    </script>

@endpush
@endsection
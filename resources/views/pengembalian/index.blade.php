@extends('layouts.master')
@section('content')


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Pengembalian</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pengembalian Proses
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-detail">
                            <thead>
                                <tr>
                                    <th width="10%">Penanggung Jawab</th>
                                    <th width="10%">Peminjaman Via</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Jatuh Tempo</th>
                                    <th width="10%"></th>
                                    <th width="10%">Jenis Hak</th>
                                    <th width="10%"></th> 
                                    <th width="10%"></th> 
                                    <th width="10%">No.Warkah</th>
                                    <th width="10%">No.SU</th>
                                    <th width="10%">Keterangan</th>
                                    <th width="10%">Status</th>
                                    <th width="12%">Action</th>
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
    @include('pengembalian.modaldetail')


@push('scripts')
<script>

    $(document).on('click', "#cekdetail", function (e) {
        e.preventDefault();
        var id = $(this).data('id_detail');
        var status_detail = $(this).data('value');
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url: "{{ url('pengembaliancekdetail')}}",
            type: "GET",
            data: {id:id,status_detail:status_detail},
                success: function (data) {
                $('#data-detail').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
            },
                error: function () {
                alert('Oops! error!');
            }
        });
    });

    var TableDetail;
    $(document).ready(function () {
        var TableDetail;
        'use strict';
        TableDetail = $('#data-detail').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            "bDestroy": true,
            ajax:"{{ url('api/pengembaliandetail')}}",
            columns: [
                {data: 'peminjamanheader.nama',name:'peminjamanheader.nama'},
                {data: 'peminjamanheader.via',name:'peminjamanheader.via'},
                {data: 'peminjamanheader.tanggal_pinjam',name:'peminjamanheader.tanggal_pinjam'},
                {data: 'peminjamanheader.tanggal_kembali',name:'peminjamanheader.tanggal_kembali'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
                {data: 'no_warkah',name:'no_warkah'},
                {data: 'no_su',name:'no_su'},
                {data: 'peminjamanheader.kegiatan.nama_kegiatan',name:'peminjamanheader.kegiatan.nama_kegiatan'},

                {   
                    data: 'status_detail',
                    name:'status_detail',
                    "render": function ( data, type, row ){
                        if(data === '3'){
                            return '<span class="label label-warning">Belum Divalidasi</span>';
                        }
                        else{
                            return '<span class="label label-warning">Belum Dikembalikan</span>';
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
            iDisplayLength: 25
        }),
         yadcf.init(TableDetail, [
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
        
    });
</script>

@endpush
@endsection

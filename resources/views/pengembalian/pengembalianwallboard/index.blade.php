@extends('layouts.master')
@section('content')


<div class="">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">
                   <b>WALLBOARD PEMINJAMAN</b>
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="">
                        <table class="table table-hover table-striped table-borderless" id="data-detail">
                            <thead>
                                <tr>
                                    {{-- <th width="10%">Id Buku Tanah</th>
                                    <th>NIP</th> --}}
                                    <th width="10%">Penanggung.Jawab</th>
                                    <th width="10%">Peminjaman.Via</th>
                                    <th>Tanggal.Pinjam</th>
                                    <th width="10%">No.Hak</th>
                                    <th width="10%">Jenis.Hak</th>
                                    <th width="10%">Desa</th> 
                                    <th width="10%">Kecamatan</th> 
                                    <th width="10%">No.Warkah</th>
                                    <th width="10%">No.SU</th>
                                    <th width="10%">Keterangan</th>
                                    <th>Tanggal.Kembali</th>
                                    <th width="10%">Status</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  


@push('scripts')
<script>
    $('#sidebar-collapse').hide();
    $(function () {
        var selectors = [
            ":lt(2)",
            ":gt(5)"
        ];
        var $tableslide = $("#table-body").children(selectors[1]).hide().end();
        var state = false;
        setInterval(function () {
            var s = state;
            $tableslide.children(selectors[+s]).fadeOut().promise().then(function () {
                $tableslide.children(selectors[+!s]).fadeIn();
            });
            state = !state;
        }, 7000);
    });


    

    var TableDetail;
    $(document).ready(function () {
        var TableDetail;
        'use strict';
        TableDetail = $('#data-detail').DataTable({
            "dom": '<"toolbar">rti',
            colReorder: true,
            processing: true,
            serverSide:true,
            "bDestroy": true,
            ajax:"{{ url('api/pengembalianwallboard')}}",
            columns: [
                // {data: 'idbukutanah',name:'idbukutanah'},
                // {data: 'peminjamanheader.nip',name:'peminjamanheader.nip'},
                {data: 'peminjamanheader.nama',name:'peminjamanheader.nama'},
                {data: 'peminjamanheader.via',name:'peminjamanheader.via'},
                {data: 'peminjamanheader.tanggal_pinjam',name:'peminjamanheader.tanggal_pinjam'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
                {data: 'no_warkah',name:'no_warkah'},
                {data: 'no_su',name:'no_su'},
                {data: 'peminjamanheader.kegiatan.nama_kegiatan',name:'peminjamanheader.kegiatan.nama_kegiatan'},
                {data: 'tanggal_kembali',name:'tanggal_kembali'},

                {   
                    data: 'status_detail',
                    name:'status_detail',
                    "render": function ( data, type, row ){
                        if(data === '1'){
                            return '<span class="label label-success">Di Kegiatan</span>';
                        }else  if(data === '3'){
                            return '<span class="label label-success">Di Pengembalian</span>';
                        }
                        else  if(data === '4'){
                            return '<span class="label label-success">Sudah Divalidasi</span>';
                        }
                        else{
                            return '<span class="label label-warning">Di Tunggakan</span>';
                        }
                        
                    }
                },
            ],   
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            iDisplayLength: 25
        }),
         yadcf.init(TableDetail, [  
        ]);
        
    });
</script>

@endpush
@endsection

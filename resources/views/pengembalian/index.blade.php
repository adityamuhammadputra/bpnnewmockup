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
                    Proses Pengembalian
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
               
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-pengembalian">
                            <thead>
                                <tr>
                                    <th>No.Berkas</th>
                                    <th>NIP</th>
                                    <th></th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Keterangan</th>
                                    <th nowrap></th>
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
            url: "{{ url('pengembaliancek')}}",
            type: "GET",
            data: {status:status, id:id},
                success: function (data) {
                $('#data-pengembalian').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
            },
                error: function () {
                alert('Oops! error!');
            }
        });
    });
    var Table;
    $(document).ready(function () {
        var Table;
        'use strict';
        Table = $('#data-pengembalian').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            ajax:"{{ url('api/pengembalian') }}",
            columns: [
                {data: 'id',name:'id'},
                {data: 'nip',name:'nip'},
                {data: 'nama',name:'nama'},
                {data: 'kegiatan',name:'kegiatan'},
                {data: 'tanggal_pinjam',name:'tanggal_pinjam'},
                {data: 'tanggal_kembali_asli',name:'tanggal_kembali_asli'},
                {   
                    data: 'status',
                    name:'status',
                    "render": function ( data, type, row ){
                        if(data === '1'){
                            return '<span class="label label-success">Sudah Dikembalikan</span>';
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
            {{-- iDisplayLength: 15 --}}
        }),
       
        yadcf.init(Table, [
            {
                column_number: 2,
                filter_type: "text",
                filter_delay: 500,
                filter_default_label: "Nama Peminjam"
            },
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

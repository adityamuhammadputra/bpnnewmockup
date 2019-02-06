@extends('layouts.master')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"  style="text-align: center;">
                    <b>Peminjaman Tunggakan </b>
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-peminjaman">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="10%"></th>
                                    <th width="10%"></th>
                                    <th>Tanggal Pinjam</th>
                                    <th width="10%"></th>
                                    <th width="10%">Jenis Hak</th>
                                    <th width="10%"></th> 
                                    <th width="10%">Kecamatan</th> 
                                    <th width="10%">No.Warkah</th>
                                    <th width="10%">No.SU</th>
                                    <th width="10%">Keterangan</th>
                                    <th>Jatuh Tempo</th>
                                    {{-- <th width="10%">Status</th> --}}
                                    <th width="5%"></th>
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

    $(document).on('click', "#cekdetails", function (e) {
        e.preventDefault();
        var id_detail = $(this).data('value');
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
        url: "{{ url('tunggakancekdetail')}}",
            type: "GET",
            data: {id_detail:id_detail},
                success: function (data) {
                $('#data-peminjaman').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
            },
                error: function () {
                alert('Oops! error!');
            }
        });
    });

        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-peminjaman').DataTable({
                //  "bPaginate": false,
                //   "bInfo": false,
                "sDom" : "tr",
                //  "paging": false,
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/tunggakan') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'peminjamanheader.nama',name:'peminjamanheader.nama'},
                    {data: 'peminjamanheader.via',name:'peminjamanheader.via'},
                    {data: 'peminjamanheader.tanggal_pinjam',name:'peminjamanheader.tanggal_pinjam'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'jenis_hak',name:'jenis_hak'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    {data: 'no_warkah',name:'no_warkah'},
                    {data: 'no_su',name:'no_su'},
                   {data: 'peminjamanheader.unit_kerja',name:'peminjamanheader.unit_kerja'},
                    {data: 'peminjamanheader.tanggal_kembali',name:'peminjamanheader.tanggal_kembali'},
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
                iDisplayLength: -1
            }),
           
            yadcf.init(Table, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Peminjam"
                },
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Peminjam Via"
                },
                {
                    column_number: 4,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No.Hak"
                },
                {
                    column_number: 6,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Desa"
                },
            ]);
            
            Table.on( 'draw.dt', function () {
                var PageInfo = $('#data-peminjaman').DataTable().page.info();
                     Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
           
        setInterval( function () {
                TableDetail.ajax.reload( null, false ); // user paging is not reset on reload
            }, 3000 );
        
    });

      $('#sidebar-collapse').hide();
</script>

@endpush
@endsection

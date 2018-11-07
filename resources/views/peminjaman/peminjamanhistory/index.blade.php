@extends('layouts.master')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-check-square-o"></em>
            </a></li>
            <li class="active">Buku Tanah</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    History Buku Tanah
                    <div class="pull-right col-md-4"> 
                        <form class="form-group" method="POST" action="{{url('cetakhistorypeminjaman')}}" target="_blank">
                            @method('POST')
                            @csrf
                            <div class='input-group'>
                                <div class="col-md-7">
                                    <select class="form-control" name="bulan" required>
                                        <option value="01">Januari</option>
                                        <option value="02">Febuari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <select class="form-control" name="tahun" required>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                <span class="input-group-addon">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-print"></i></button>
                                {{-- <button type="submit" class="btn btn-primary"> Cetak</button> --}}

                                </span>

                            </div>
                            <span class="help-block with-errors"></span>
                        </form>

                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th></th>
                                    <th>Jenis Hak</th>
                                    <th></th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Ruang</th>
                                    <th>Rak</th>
                                    <th>Baris</th>
                                    <th>Tanggal Pinjam</th>
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
                ajax:"{{ url('api/peminjamanhistory') }}",
                columns: [
                    {data: null,name:'false'},
                    {data: 'no_box',name:'no_box'},
                    {data: 'idbukutanah',name:'idbukutanah'},
                    {data: 'jenis_hak',name:'jenis_hak'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    {data: 'ruang',name:'ruang'},
                    {data: 'rak',name:'rak'},
                    {data: 'baris',name:'baris'},
                    {data: 'created_at',name:'created_at'},
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    // lengthChange:false,
                    targets: 0
                } ], 
                order: [[ 10, 'desc' ]],
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
                    filter_default_label: "No Bundel"
                },
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Buku Tanah"
                },
                {
                    column_number: 4,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No Hak"
                },
                
            ]);
            Table.on( 'order.dt search.dt', function () {
                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw(); 
        });
        

        $(document).ready(function() {
            var dateNow = new Date();
            $(function() {
                $('#bulan').datetimepicker({
                   format: 'LT'
                });

            
            });
        });
        
        

        $(document).on('click', "#cekpinjam", function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var status_pinjam = $(this).data('value');
            
              $.ajax({
              url: "{{ url('peminjamanhistorycekpijam')}}",
              type: "GET",
              data: {status_pinjam:status_pinjam , id:id},
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
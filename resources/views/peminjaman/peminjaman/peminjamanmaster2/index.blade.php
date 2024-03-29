@extends('layouts.master')



@section('content')

<style>

        .modal-title{

            color: white;

        }

</style>

<div class="">

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

                    @include('peminjaman.peminjamanmaster2.form')

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

                                    <th></th>

                                    <th></th>

                                    <th>Ruang</th>

                                    <th>Rak</th>

                                    <th>Baris</th>

                                    <th>Keterangan</th>

                                    <th style="coba"> Action </th>

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

        $('#sidebar-collapse').hide();



        var Table;

        $(document).ready(function () {

            var Table;

            'use strict';

            Table = $('#data-master').DataTable({

                colReorder: true,

                processing: true,

                serverSide:true,

               
                ajax:"{{ url('api/peminjamanmaster2') }}",


                columns: [

                    {data: 'no_box',name:'no_box'},

                    {data: 'no_box',name:'no_box'},

                    {data: 'idbukutanah',name:'idbukutanah'},

                    {data: 'jenis_hak',name:'jenis_hak'},

                    {data: 'no_hak',name:'no_hak'},

                    {data: 'desa',name:'desa'},

                    {data: 'kecamatan',name:'kecamatan'},

                    {data: 'ruang',name:'ruang'},

                    {data: 'rak',name:'rak'},

                    {data: 'baris',name:'baris'},

                    {   

                        data: 'status_pinjam',

                        name:'status_pinjam',

                        "render": function ( data, type, row ){

                            if(data == '0'){

                                return '<span class="label label-success">Berkas Tersedia</span>';

                            }

                            else{

                                return '<span class="label label-warning">Sedang dipinjam</span>';

                            }

                            

                        }

                    },

                    {data: 'action',name:'action',orderable:false, searchable:false}

                ],

                 columnDefs: [ {

                        searchable: false,

                        orderable:false ,

                        lengthChange: false,

                        targets: 0

                    },

                    { width: '20%', targets: 11 } ], 

                order: [[ 10, 'asc' ]],

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

                // iDisplayLength: 15

            })

        

            yadcf.init(Table, [

                {

                    column_number: 1,

                    filter_type: "text",

                    filter_delay: 500,

                    filter_default_label: "Bundel"

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

                    filter_default_label: "Hak"

                },

                {

                    column_number: 5,

                    filter_type: "text",

                    filter_delay: 500,

                    filter_default_label: "Desa"

                },

                {

                    column_number: 6,

                    filter_type: "text",

                    filter_delay: 500,

                    filter_default_label: "Kecamatan"

                },

                

            ]);

            Table.on( 'order.dt search.dt', function () {

                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {

                    cell.innerHTML = i+1;

                } );

            } ).draw();

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

            

        function editForm(id) {

            $('#form-panel').show();

            save_method = 'edit';

            $('input[name=_method]').val('PATCH');

            $('#form-peminjamanmaster form')[0].reset();

            $.ajax({

                url: "{{ url('peminjaman/master')}}/" + id + "/edit",

                type: "GET",

                dataType: "JSON",

                success: function (data) {

                    $('.tombol-simpan').text('Perbaharui');

                    $('#id').val(data.id);

                    $('#no_box').val(data.no_box);

                    $('#idbukutanah').val(data.idbukutanah);

                    $('#jenis_hak').val(data.jenis_hak);

                    $('#no_hak').val(data.no_hak);

                    $('#desa').val(data.desa);

                    $('#kecamatan').val(data.kecamatan);

                    $('#ruang').val(data.ruang);

                    $('#rak').val(data.rak);

                    $('#baris').val(data.baris);

                    $('#status').val(data.status);

                },

                error: function () {

                    alert("Data tidak ada!");

                }

            });

        }



         $(function () {

            $('#form-peminjamanmaster form').validator().on('submit', function (e) {

                if (!e.isDefaultPrevented()) {

                    var id = $('#id').val();

                    if (save_method == 'add') url = "{{ url('peminjaman/master') }}"; 

                    else url = "{{ url('peminjaman/master') . '/'}}" + id;

                    $.ajax({

                        url: url,

                        type: "POST",

                        data: $('#form-peminjamanmaster form').serialize(),

                        success: function (data) {

                            $('#data-master').dataTable().api().ajax.reload();

                            $('#form-peminjamanmaster form')[0].reset();

                            $('#form-panel').show();

                            $('.tombol-simpan').text('Simpan');

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

                    return false;

                }

            });

        });



        function deleteData(id) {

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

                    url: "{{ url('peminjaman/master')}}/" + id,

                    type: "POST",

                    data: {'_method': 'DELETE','_token': csrf_token

                    },

                    success: function(data) {

                        $('#data-master').dataTable().api().ajax.reload();

                        $("#form-peminjamanmaster").load(document.URL + '" #form-pengecekan"');

                        $('#form-peminjamanmaster form')[0].reset();

                        $('#form-panel').show();

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



       

          $(document).on('click', "#cekpinjam", function (e) {

            e.preventDefault();

            var id = $(this).data('id');

            var status_pinjam = $(this).data('value');

            

              $.ajax({

              url: "{{ url('peminjamanmastercekpijam')}}",

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
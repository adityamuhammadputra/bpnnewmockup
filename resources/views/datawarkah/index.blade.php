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
                <em class="fa fa-sticky-note"></em>
            </a></li>
            <li class="active">Data Warkah</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Master Data Warkah 
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-warkah">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="4%"></th>
                                    <th>No Box</th>
                                    <th width="1%"></th>
                                    <th>Lokasi Ruang</th>
                                    <th>Baris</th>
                                    <th>Posisi</th>
                                    <th>Rak</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    {{--  </div>  --}}
                </div>
            </div>
        </div>
    </div>
    @include('datawarkah.form')

@push('scripts')
    <script>
        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-warkah').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.warkah') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'no_warkah',name:'no_warkah'},
                    {data: 'no_box',name:'no_box'},
                    {data: 'tahun',name:'tahun'},
                    {data: 'lokasi_ruang',name:'lokasi_ruang'},
                    {data: 'baris',name:'baris'},
                    {data: 'posisi',name:'posisi'},
                    {data: 'rak',name:'rak'},
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
        
            yadcf.init(Table, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nomor Warkah"
                },
                {
                    column_number: 3,
                    filter_type: "text",
                    filter_default_label: "Tahun Warkah"
                }
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
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('#id').val('');
            $('.modal-title').text('Tambah Data Warkah');
            $('.tombol-simpan').text('Simpan');
        }
        function editData(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('datawarkah')}}/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Data Warkah');
                    $('.tombol-simpan').text('Perbaharui');

                    $('#id').val(data.id);
                    $('#no_warkah').val(data.no_warkah);
                    $('#no_box').val(data.no_box);
                    $('#tahun').val(data.tahun);
                    $('#lokasi_ruang').val(data.lokasi_ruang);
                    $('#posisi').val(data.posisi);
                    $('#rak').val(data.rak);
                    $('#baris').val(data.baris);
                },
                error: function () {
                    alert("Data tidak ada!");
                }
            });
        }

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
                    url: "{{ url('datawarkah')}}/" + id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-warkah').dataTable().api().ajax.reload();
                        swal({
                            title:'Berhasil!',
                            text:'Data Berhasil Diperbarui',
                            type:'success',
                            timer:'1500'
                        })
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
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('datawarkah') }}"; 
                    else url = "{{ url('datawarkah') . '/'}}" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function ($data) {
                            $('#modal-form').modal('hide');
                            $('#data-warkah').dataTable().api().ajax.reload();
                            {{-- $("#data-warkahh").load(" #data-warkahh"); --}}
                            swal({
                                title:'Berhasil!',
                                text:'Permintaan anda berhasil',
                                type:'success',
                                timer:'1500'
                            })
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
    </script>

@endpush
@endsection
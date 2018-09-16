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
            <li class="active">Data Pengecekan</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Master Data Pengecekan Berkas Fisik PTSL
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    </div>
                    <div class="panel-body" id="form-panel">
                        @include('ptsl.pengecekan.form')
                    </div>
                   
                    
                    
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <form method="POST" action="{{ url('cetak/pengecekan ') }}"  target="_blank" class="cetaknobox">
                                {{csrf_field()}}
                                {{ method_field('POST') }}
                                <input type="hidden" id="cetak" name="cetak">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> </button>
                            </form>
                            <table class="table table-hover table-striped table-borderless table-responsive" id="data-pengecekan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Berkas</th>
                                        <th></th>
                                        <th>No.208</th>
                                        <th>No.SU</th>
                                        <th>Tahun</th>
                                        <th></th>
                                        <th>Desa</th>
                                        <th>Kecamatan</th>
                                        <th>No.Box</th>
                                        <th>TIM</th>
                                        <th>Keterangan</th> 
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        {{-- var cetak = $('#yadcf-filter--data-pengecekan-9').val();
        console.log(cetak); --}}


          $('#data-pengecekan').on('search.dt', function() {
            var value = $('.dataTables_filter input').val();
            $('#cetak').val(value);

        }); 

        $('#form-panel').hide();

        var Table;
        $(document).ready(function () {
           
            var Table;
            'use strict';
            Table = $('#data-pengecekan').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.pengecekan') }}",
                columns: [
                    {data: 'id',name:'id', searchable:false},
                    {data: 'no_berkas',name:'no_berkas', searchable:false},
                    {data: 'no_hak',name:'no_hak', searchable:false},
                    {data: 'no_208',name:'no_208', searchable:false},
                    {data: 'no_su',name:'no_su', searchable:false},
                    {data: 'tahun',name:'tahun', searchable:false},
                    {data: 'pemegang',name:'pemegang'},
                    {data: 'desa',name:'desa', searchable:false},
                    {data: 'kecamatan',name:'kecamatan', searchable:false},
                    {data: 'no_box',name:'no_box'},
                    {data: 'kelompok_id',name:'kelompok_id', searchable:false},
                    {data: 'keterangan',name:'keterangan', searchable:false},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                {{--  columnDefs: [ {
                    searchable: false,
                    orderable: ,
                    targets: 0
                } ],  --}}
                {{-- order: false, --}}
                language: {
                    lengthMenu: "Menampilkan _MENU_",
                    zeroRecords: "Data yang anda cari tidak ada, Silahkan masukan keyword lainnya",
                    info: "Halaman _PAGE_ dari _PAGES_ Halaman",
                    infoEmpty: "-",
                    infoFiltered: "(dari _MAX_ total data)",
                    loadingRecords: "Silahkan Tunggu...",
                    processing:     "Dalam Proses...",
                    search:         "Cetak No Box:",
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
                    column_number: 6,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Pemegang"
                },
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No.Hak"
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
            $('#form-pengecekan form')[0].reset();
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $("#form-pengecekan").load(" #form-pengecekan");  
            $('#form-pengecekan form')[0].reset();
            $("#form-panel").slideUp();
        }
       
        function editData(id) {
            $('#form-panel').show();
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#form-pengecekan form')[0].reset();
            $.ajax({
                url: "{{ url('pengecekan')}}/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('.tombol-simpan').text('Perbaharui');
                    $('#id').val(data.id);
                    $('#no_berkas').val(data.no_berkas);
                    $('#no_hak').val(data.no_hak);
                    $('#no_208').val(data.no_208);
                    $('#no_su').val(data.no_su);
                    $('#tahun').val(data.tahun);
                    $('#pemegang').val(data.pemegang);
                    $('#desa').val(data.desa);
                    $('#kecamatan').val(data.kecamatan);
                    $('#no_box').val(data.no_box);
                    $('#keterangan').val(data.keterangan);
                    $('#ruang').val(data.ruang);
                    $('#rak').val(data.rak);
                    $('#baris').val(data.baris);
                    $('#posisi').val(data.posisi);
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
                    url: "{{ url('pengecekan')}}/" + id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-pengecekan').dataTable().api().ajax.reload();
                        $("#form-pengecekan").load(document.URL + '" #form-pengecekan"');
                        $('#form-pengecekan form')[0].reset();
                        $("#form-panel").slideUp();
                        swal({
                            title:'Berhasil!',
                            text:'Data Berhasil Dihapus',
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
            $('#form-pengecekan form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('pengecekan') }}"; 
                    else url = "{{ url('pengecekan') . '/'}}" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#form-pengecekan form').serialize(),
                        success: function (data) {
                            $('#data-pengecekan').dataTable().api().ajax.reload();
                            $('#form-pengecekan form')[0].reset();
                            $('#form-panel').hide();
                            $('.tombol-simpan').text('Simpan');
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
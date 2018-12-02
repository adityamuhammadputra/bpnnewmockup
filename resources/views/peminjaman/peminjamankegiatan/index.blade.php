@extends('layouts.master')

@section('content')
<style>
    .containers {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    /* Hide the browser's default checkbox */
    .containers input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .containers:hover input ~ .checkmark {
    background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containers input:checked ~ .checkmark {
    background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    }

    /* Show the checkmark when checked */
    .containers input:checked ~ .checkmark:after {
    display: block;
    }

    /* Style the checkmark/indicator */
    .containers .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Peminjaman</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Peminjaman Kegiatan
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                </div>
                <div class="panel-body" id="form-panel">
                </div>
                <form method="POST" action="{{url('peminjaman/kegiatan')}}">
                    @method('POST')
                    @csrf
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-borderless table-responsive" id="data-peminjaman">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th></th>
                                        <th width="10%">Id BukuTanah</th>
                                        <th width="10%"></th>
                                        <th width="10%">Jenis Hak</th>
                                        <th width="10%"></th> 
                                        <th width="10%">Kecamatan </th> 
                                        <th width="10%">No.Warkah</th>
                                        <th width="10%">No.SU</th>
                                        <th>Jatuh Tempo</th>
                                        <th><input type="checkbox" onclick="check(this.checked)"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @include('peminjaman.peminjamankegiatan.modaldetail') --}}
    @include('peminjaman.peminjamankegiatan.modaldetaildetail')


@push('scripts')
    <script>
        $("#form-panel").hide();
        
        // function cetak(url) {
        //     var link = "cetak/peminjamanproses/"+url;
        //     window.open(link,'_blank');
        //     window.focus();
        //     location.reload();
        // }

       function check(isChecked) {
           if (isChecked) {
               $('.checkbox').each(function () {
                   this.checked = true;
               })
           }else{
               $('.checkbox').each(function () {
                   this.checked = false;
               })
           }
       }

        function datadetail(id) {
            save_method = 'edit';
            $('#modal-formdetail form')[0].reset();
            $('input[name=_method]').val('PATCH');
            $.ajax({
                url: "{{ url('peminjamankegiatandetail')}}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-formdetail').modal('show');
                    $('#id').val(data.id);
                    $('#idbukutanah').val(data.idbukutanah);
                    $('#no_hak').val(data.no_hak);
                    $('#jenis_hak').val(data.jenis_hak);
                    $('#desa').val(data.desa);
                    $('#kecamatan').val(data.kecamatan);
                    $('#no_warkah').val(data.no_warkah);
                    $('#no_su').val(data.no_su);
                },
                error: function () {
                    alert("Data tidak ada!");
                }
            });
        }

        $(function () {
            $('#modal-formdetail form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    url = "{{ url('peminjamankegiatandetailupdate') . '/'}}" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-formdetail form').serialize(),
                        success: function (data) {
                            $('#modal-formdetail').modal('hide');
                            $('#data-detail').dataTable().api().ajax.reload();
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

        $(function () {
            $('#form-peminjamanproses form').validator().on('submit', function (e) {

            });
        });


        var Table;
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
                ajax:"{{ url('api/peminjamankegiatan') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'peminjamanheader.via',name:'peminjamanheader.via'},
                    {data: 'peminjamanheader.tanggal_pinjam',name:'peminjamanheader.tanggal_pinjam'},
                    {data: 'idbukutanah',name:'idbukutanah'},
                    {data: 'no_hak',name:'no_hak'},
                    {data: 'jenis_hak',name:'jenis_hak'},
                    {data: 'desa',name:'desa'},
                    {data: 'kecamatan',name:'kecamatan'},
                    {data: 'no_warkah',name:'no_warkah'},
                    {data: 'no_su',name:'no_su'},
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
                    filter_default_label: "Pinjam Via"
                },
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Tgl Pinjam"
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
           
        });
        
        function cetak() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $('#nama').val('');
            $('#nik').val('');
            $('#unit_kerja').val('');
        }

        $(document).on('click', "#cek", function (e) {
            e.preventDefault();
            var id = $(this).data('id')
            var status = $(this).data('value');
            swal({
                title: 'Apakah anda yakin ingin mengembalikan semua berkas?',
                text: "Konfirmasi Pengembalian Berkas",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Kembalikan',
                cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
            }).then(function(){  
                $.ajax({
                    url: "{{ url('peminjamankegiatancek')}}",
                    type: "GET",
                    data: {status:status, id:id},
                        success: function (data) {
                        $('#data-peminjaman').dataTable().api().ajax.reload();
                        $('div.flash-message').html(data);
                    },
                        error: function () {
                        alert('Oops! error!');
                    }
                });
            });
        });
        

    </script>

@endpush
@endsection
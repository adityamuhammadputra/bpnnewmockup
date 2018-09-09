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
            <li class="active">Data Master Peminjaman</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Master Peminjaman
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                </div>
                <div class="panel-body" id="form-panel">
                    @include('peminjaman.peminjamanproses.form')
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-peminjaman">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nik</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pinjam</th>
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
        $('#form-panel').hide();

        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-peminjaman').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ route('api.peminjaman.proses') }}",
                columns: [
                    {data: 'id',name:'id'},
                    {data: 'nik',name:'nik'},
                    {data: 'nama',name:'nama'},
                    {data: 'tanggal',name:'tanggal'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                {{--  columnDefs: [ {
                    searchable: false,
                    orderable: ,
                    targets: 0
                } ],  --}}
                order: false,
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
        
            
            {{--  Table.on( 'order.dt search.dt', function () {
                Table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();  --}}
        });

        $(document).ready(function(){
            $(document).on('click', '.add', function(){
            var html = '';
            html += '<tr class="tr-custom">';
            // html += '<td style="display:none;"><input type="hidden" name="no_hak[]" class="form-custom no_hak" value="Isi Nomor Hak"</td>';
            html += '<td><input type="text" name="idbukutanah[]" class="form-control autocomplete_txt" placeholder="Cari Buku Tanah" /></td>';
            html += '<td><input type="text" name="no_hak[]" class="form-control" placeholder="Isi Nomor Hak" /></td>';
            html += '<td><input type="text" name="jenis_hak[]" class="form-control" placeholder="Masukan Jenis Hak" /></td>';
            html += '<td><input type="text" name="desa[]" class="form-control" placeholder="Masukan Nama Desa" /></td>';
            html += '<td><input type="text" name="kec[]" class="form-control" placeholder="Masukan Kecamatan" /></td>';
            html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
            html += '</tr>';
            $('#item_table').append(html);
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });
        });

        $(document).on('focus','.autocomplete_txt',function(){
            src = "{{ route('peminjaman.proses.autocomplete') }}";
            $(this).autocomplete({
                minLength: 0,
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            
                           console.log(data[0].id);
                            
                           response(data);
                        }
                    }); 
                },
                select: function( event, ui ) {
                    id_arr = $(this).attr('id');
                    var data = ui.item.data; 
                    console.log(data.idbukutanah);
                    $.ajax({
                        type: "GET",
                        url: "{{route('peminjaman.proses.autocomplete.show')}}",
                        data : {
                            idbukutanah : data
                        },
                        cache: false,
                        dataType: "html",
                        beforeSend  : function(){
                            $(".prosesloading").show();   
                        },
                        success: function(data){
                            var datashow = JSON.parse(data); 
                            $("#" + id_arr).val(datashow[0].desa);
                            
                        }
                    });
                },
                minLength: 3,
            });
        });

        function addData() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#form-peminjamanproses form')[0].reset();
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $("#form-peminjamanproses").load(" #form-peminjamanproses");  
            $('#form-peminjamanproses form')[0].reset();
            $("#form-panel").slideUp();
        }

    </script>

@endpush
@endsection
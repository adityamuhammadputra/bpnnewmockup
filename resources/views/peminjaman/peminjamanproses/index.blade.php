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
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Peminjaman</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Proses Peminjaman
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                    </div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i id="hiden" class="fa fa-minus-circle"></i> Hide Form</button>
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
                                    <th>No.Berkas</th>
                                    <th>Nama Peminjam</th>
                                    <th>Kegiatan</th>
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
        {{-- $('#form-panel').hide(); --}}

        function deleteData(id){
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
                    url: "{{ url('peminjaman/proses')}}/"+id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-peminjaman').dataTable().api().ajax.reload();
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

        $(function () {
            $('#form-peminjamanproses form').validator().on('submit', function (e) {

            });
        });


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
                    {data: 'kegiatan',name:'kegiatan'},
                    {data: 'tanggal_pinjam',name:'tanggal_pinjam'},
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],  
                order: [[ 2, 'asc' ]],
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
        var i=$('table tr').length;

        $(document).ready(function(){
            $(document).on('click', '.add', function(){
            var html = '';
            html += '<tr>';
            // html += '<td style="display:none;"><input type="hidden" name="no_hak[]" class="form-custom no_hak" value="Isi Nomor Hak"</td>';
                        // html += '<td><input type="text" name="nip_kegiatan[]" class="form-control autocomplete_txt" data-type="nm_peg" id="nm_peg'+i+'" placeholder="Nip Kegiatan" required/></td>';

            html += '<td><input type="text" name="idbukutanah[]" id="idbukutanah'+i+'" data-type="idbukutanah" class="form-control autocomplete_txt" placeholder="Cari Buku Tanah" /></td>';
            html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" /></td>';
            html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control" placeholder="Jenis Hak" /></td>';
            html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control" placeholder="Desa" /></td>';
            html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control" placeholder="Kecamatan" /></td>';
            html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
            html += '</tr>';
            $('#item_table').append(html);
            i++;
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });
        });

        $(document).on('focus','.autocomplete_txt',function(){
            type = $(this).data('type');
            if(type =='idbukutanah' )autoType='idbukutanah'; 
            src = "{{ route('peminjaman.proses.autocomplete') }}";
            $(this).autocomplete({
                minLength: 0,
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term,
                            type : type,
                        },
                        success: function(data) {
                            var array = $.map(data, function (item) {
                                return {
                                    label: item[autoType],
                                    value: item[autoType],
                                    data : item.id
                                }
                            });
                            response(array)
                        }
                    }); 
                },
                select: function( event, ui ) {
                    id_arr = $(this).attr('id');
                    elementId = id_arr.substring(11);
                    var data = ui.item.data; 
                    console.log(elementId);
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
                            console.log(id_arr); 
                            $("#idbukutanah" + elementId).val(datashow[0].idbukutanah);
                            $("#no_hak" + elementId).val(datashow[0].no_hak);
                            $("#jenis_hak" + elementId).val(datashow[0].jenis_hak);
                            $("#desa" + elementId).val(datashow[0].desa);
                            $("#kecamatan" + elementId).val(datashow[0].kecamatan);
                        }
                    });
                },
                minLength: 3,
            });
        });

        function addData() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            $('#nama').val('');
            $('#nik').val('');
            $('#unit_kerja').val('');
        }

    </script>

@endpush
@endsection
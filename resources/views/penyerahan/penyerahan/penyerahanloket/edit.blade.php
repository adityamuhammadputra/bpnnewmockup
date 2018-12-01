@extends('layouts.master')

@section('content')
<style>
    #group-foto img{
        /* padding: 1px; */
        border: 3px solid #c1c1c1;
        padding: 2px;
        border-radius: 2px;
        height: 315px;
    }
    #group-foto a{
        width: 322px;
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Penyerahan</li>
            <div class="pull-right">
                <a href="{{url('penyerahanloket')}}" class="btn btn-default text-white"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Penyerahan <a class="text-primary">#{{$data['detail']->no_berkas}} , Kode Box : #{{$data['detail']->kd_box}}</a>
                    <div class="pull-right">
                    @if($data['detail']->foto != 'app/public/default.png')
                        <a href="#" onclick="cetak({{$data['detail']->id}})"  class ="btn btn-info"><em class="fa fa-print"></em> Cetak Dokument</a>
                    @endif
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ url('penyerahanloket',$data['detail']->id)}}" data-toogle="validator" class="form-horzontal" id="form-detail">
                        {{csrf_field()}}
                        {{method_field ('PATCH')}} 
                        <input type="hidden" class="form-control" name="no_berkas" id="no_berkas" value="{{$data['detail']->no_berkas}}" required >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="nama1" id="nama1" value="{{$data['detail']->nama1}}" readonly required >
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Jenis Permohonan</label>
                                    {{ Form::select('kegiatan_id', $data['kegiatan'],old('kegiatan',$data['detail']->kegiatan_id), ['id' => 'kegiatan_id', 'class' => 'form-control', 'readonly'=>'true']) }}
                                    <span class="help-block with-errors"></span>
                                </div>
                                 <div class="form-group">
                                    <label for="" class="control-label">Email Notifikasi</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{$data['detail']->email}}" readonly>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <input type="text" class="form-control" name="status" id="status" value="Siap Diserahkan" readonly required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Tanggal Dokumen Selesai</label>
                                    <div class='input-group'>
                                        <input type='text' id="tanggal1" name="tanggal1" value="{{$data['detail']->tanggal1}}" class="form-control date" readonly required/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label">Penerima Dokumen</label>
                                    <select id="kuasa" name="kuasa" class="form-control">
                                        <option value="1" @if($data['detail']->kuasa == '1')  {{'selected'}} @endif>Non Kuasa</option>
                                        <option value="0" @if($data['detail']->kuasa == '0') {{'selected'}} @endif>Kuasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Penerima Dokumen</label>
                                    <input type="text" class="form-control" name="nama2" id="nama2" value="{{$data['detail']->nama2}}" required >
                                    <span class="help-block with-errors"></span>
                                </div>
                                {{-- @if($data['detail']->kuasa == 0) --}}
                                <div id="nonkuasa">
                                    <div class="form-group">
                                        <label for="name" class="control-label">NIK Penerima Dokumen</label>
                                        <input type="text" class="form-control" name="nik2" id="nik2" value="{{$data['detail']->nik2}}" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Penerima Dokumen</label>
                                        <input type="text" class="form-control" name="alamat2" id="alamat2" value="{{$data['detail']->alamat2}}" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                <div class="form-group">
                                    <label for="name" class="control-label">Tanggal Penerima Dokumen</label>
                                    <div class='input-group'>
                                        <input type='text' id="tanggal2" name="tanggal2" class="form-control date" required/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="group-foto">
                                    <img src="{{asset('storage/'.$data['detail']->foto)}}"><br>
                                    <a id="detailData" data-id="{{$data['detail']->id}}" data-no_berkas="{{$data['detail']->no_berkas}}" class="btn btn-primary"><i class="fa fa-camera"></i> Ambil Gambar</a>
                                </div>
                            
                            </div>
                        </div>
                        <div class="row text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan </button>
                            <a href="{{url('penyerahanloket',$data['detail']->id).'/edit'}}" class="btn btn-default"> <i class="fa fa-times-circle"></i> Batal</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-borderless table-responsive" id="data-detail">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="15%">Id Buku Tanah</th>
                                        <th width="10%"></th>
                                        <th width="10%">Jenis Hak</th>
                                        <th width="7%">No.DI 208</th>
                                        <th width="7%">Tahun</th>
                                        <th width="10%"> </th> 
                                        <th width="10%">Kecamatan </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@include('penyerahan.penyerahanloket.kamera');

@push('scripts')    
<script>
    if($('#kuasa').val() == '1'){
        $("#nonkuasa").hide();
    }
    $("#kuasa").on("change",function () {
        var cek = $("#kuasa").val();
        var nama = $("#nama1").val();
        if(cek == 0){
            $("#nonkuasa").show();
            $('#nonkuasa').find('input').attr('required', true);
            $("#nama2").val('');
            $("#alamat2").val('');
            $("#nik2").val('');
        }
        else{
            $("#nonkuasa").hide();
            $('#nonkuasa').find('input').attr('required', false);
            $("#nama2").val(nama);
            $("#alamat2").val('');
            $("#nik2").val('');
        }
    })


    
    $(document).on("click","#detailData",function () {
        $('#modal-form').modal('show');
        $('#no_berkasJudul').text($(this).data('no_berkas'));
        $('#idKamera').val($(this).data('id'));

    });  

    function cetak(url) {
        var link = "../../cetak/penyerahanloket/"+url;
            swal({
            title: 'Konfirmasi Cetak Data',
            text: "Mencatak data artinya mencetak dan validasi, Apakah anda yakin ?",
            type:'warning',
            showCancelButton:true,
            cancelButtonColor:'#d33',
            confirmButtonColor:'#3085d6',
            confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Cetak data ini',
            cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
        }).then(function(){  
            window.open(link,'_blank');
            // window.focus();
            // location.reload();
            window.location.replace("http://127.0.0.1:8000/penyerahanloket");
        })
    }
   
    $(document).ready(function(){
        $(document).on('click', '.adddetail', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="idbukutanah[]" id="idbukutanah'+i+'" data-type="idbukutanah" class="form-control autocomplete_txt" placeholder="Id Buku Tanah" /></td>';
        html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" /></td>';
        html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control" placeholder="Jenis Hak" /></td>';
        html += '<td><input type="text" name="no_warkah[]" id="no_warkah'+i+'" class="form-control" placeholder="Nomor DI 208" /></td>';
        html += '<td><input type="number" name="tahun[]" id="tahun'+i+'" class="form-control" placeholder="Tahun" /></td>';
        html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control" placeholder="Desa" /></td>';
        html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control" placeholder="Kecamatan" /></td>';
        html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
        html += '</tr>';
        $('#data-detail tbody').append(html);
        i++;
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });
    });

        var id = {{$data['id']}};

        var TableDetail;
        'use strict';
        TableDetail = $('#data-detail').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            "bDestroy": true,
            ajax:"{{ url('api/penyerahanloketdetail') .'/'}}"+ id,
            columns: [
                {data: 'id', name:'id'},
                {data: 'idbukutanah',name:'idbukutanah'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'no_warkah',name:'no_warkah'},
                {data: 'tahun',name:'tahun'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
            ],
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],  
            // order: [[ 4, 'desc' ]],
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
        })

         yadcf.init(TableDetail, [
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No. Hak"
                },
                {
                    column_number: 6,
                    filter_type: "text",
                    filter_default_label: "Desa"
                }
            ]);

             TableDetail.on( 'draw.dt', function () {
                var PageInfo = $('#data-detail').DataTable().page.info();
                     TableDetail.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
                } );
        
    function deleteDetail(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('peminjamandetail/proses')}}/" + id,
            type: "POST",
            data: {'_method': 'DELETE','_token': csrf_token
            },
            success: function(data) {
                $('#data-detail').dataTable().api().ajax.reload();
                $('#data-peminjaman').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
                    
            },
            error: function () {
                alert("Opppps gagal");
            }
        })
    }

   

    $(document).ready(function() {
        src = "{{ url('autocompletepegawai') }}";
        $("#namadetail").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                }); 
            },
            select:function(event, ui){
                var nip =ui.item.id;
                $.ajax({
                    type: "GET",
                    url: "{{ url('autocompletepegawaishow')}}",
                    data : {
                        nip : nip
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();   

                    },
                    success: function(data){
                        var datashow = JSON.parse(data); 
                        $("#namadetail").val(datashow[0].nama);
                        $("#nipdetail").val(datashow[0].nip);
                        $("#unit_kerjadetail").val(datashow[0].unit_kerja);
                        $('#kegiatandetail').val(datashow[0].kegiatan_id);
                    }
                });
            },
            minLength: 2,
        });

        $("#namadetail").autocomplete( "option", "appendTo", "#form-detail" );

    }); 

    $(document).ready(function() {
        var dateNow = new Date();
        $(function() {
            $('#tanggal2').datetimepicker({
                defaultDate:dateNow
            });
           
        });
    });
</script>
@endpush
@endsection
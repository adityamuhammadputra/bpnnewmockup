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
    
.wrapimgaes
{
    background:#e1e1e1;
    text-align: center;
    line-height: 250px;
    font-size: 11px;
}

.input-file-cus input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    width: 100%;
    text-align: center;
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
                <a href="{{ url('penyerahanloket') }}" class="btn btn-default text-white"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Penyerahan <a class="text-primary hidden-xs">#{{$wakil->nama1}}</a>
                    <div class="pull-right">
                    @if($wakil->foto != 'app/public/default.png')
                        <a href="#" onclick="cetak({{$wakil->id}})"  class ="btn btn-info"><em class="fa fa-print"></em> Cetak</a>
                    @endif
                    </div>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ url('penyerahanloket',$wakil->nama1)}}" data-toogle="validator" class="form-horzontal" id="form-detail" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field ('PATCH')}} 
                        <input type="hidden" class="form-control" name="no_berkas" id="no_berkas" value="{{$wakil->no_berkas}}" required >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="nama1" id="nama1" value="{{ $wakil->nama1}}" readonly required >
                                    <span class="help-block with-errors"></span>
                                </div>
                                 <div class="form-group">
                                    <label for="" class="control-label">Email Notifikasi</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $wakil->email}}" readonly>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <input type="text" class="form-control" name="status" id="status" value="Siap Diserahkan" readonly required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label">Penerima Dokumen</label>
                                    <select id="kuasa" name="kuasa" class="form-control">
                                        <option value="1" @if($wakil->kuasa == '1')  {{'selected'}} @endif>Non Kuasa</option>
                                        <option value="0" @if($wakil->kuasa == '0') {{'selected'}} @endif>Kuasa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nama Penerima Dokumen</label>
                                    <input type="text" class="form-control" name="nama2" id="nama2" value="{{$wakil->nama2}}" required >
                                    <span class="help-block with-errors"></span>
                                </div>
                                {{-- @if($data['detail']->kuasa == 0) --}}
                                <div id="nonkuasa">
                                    <div class="form-group">
                                        <label for="name" class="control-label">NIK Penerima Dokumen</label>
                                        <input type="text" class="form-control" name="nik2" id="nik2" value="{{$wakil->nik2}}">
                                        <span class="help-block with-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Alamat Penerima Dokumen</label>
                                        <input type="text" class="form-control" name="alamat2" id="alamat2" value="{{$wakil->alamat2}}">
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
                            <div class="col-md-4 visible-lg visible-md visible-sm">
                                <div class="form-group" id="group-foto">
                                    <img src="{{asset('storage/'.$wakil->foto)}}"><br>
                                    @if ($wakil->nama2)
                                        <a id="detailData" data-id="{{$wakil->id}}" data-no_berkas="{{ $wakil->no_berkas }}" class="btn btn-primary"><i class="fa fa-camera"></i> Ambil Gambar</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 visible-xs">
                                <div class="form-group input-file-cus" id="group-foto">
                                    <div class="wrapimgaes">
                                        <img id="blah" src="{{asset('storage/'.$wakil->foto)}}" width="100%"/>
                                    </div>
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fa fa-cloud-upload"></i> Ambil gambar
                                    </label>
                                    <input id="file-upload" type="file" name="fotomobile" style="visibility:hidden;"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-borderless table-responsive" id="data-details">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="10%"></th>
                                        <th width="10%"></th> 
                                        <th width="10%">Sms Notifikasi </th> 
                                        <th width="10%">Tanggal</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->no_berkas }}</td>
                                            <td>{{ $item->nama1 }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->tanggal1 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan </button>
                                <a href="{{ url('penyerahanloket') }}" class="btn btn-default"> <i class="fa fa-times-circle"></i> Batal</a>
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@include('penyerahan.penyerahanloket.kamera')

@push('scripts')    
<script>
    function readURL(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-upload").change(function() {
        readURL(this);
    });

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

    $(document).ready(function () {
        var nama1 = $('#nama1').val();
        $('#nama2').val(nama1);
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
            window.location.replace("https://kantahkabbogor.id/penyerahanloket");
        })
    }
   

        var TableDetail;
        'use strict';
        TableDetail = $('#data-details').DataTable({
            
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],  
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
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No. Berkas"
                },
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_default_label: "Nama Pemohon"
                }
            ]);
        
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
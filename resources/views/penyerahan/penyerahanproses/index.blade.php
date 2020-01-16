@extends('layouts.master')

@section('content')
<style>



</style>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dropbox"></em>
            </a></li>
            <li class="active">Penyerahan</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Proses Penyerahan
                        <button class="btn btn-primary pull-right btn-flat" onclick="addData()"><i id="hiden" class="fa fa-plus-circle"></i> </button>
                </div>
                <div class="panel-body" id="form-panel">
                    @include('penyerahan.penyerahanproses.form')
                     
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ url('cetak/penyerahan') }}"  target="_blank" class="cetaknobox">
                            {{csrf_field()}}
                            {{ method_field('POST') }}
                            <input type="hidden" id="cetak" name="cetak">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> </button>
                        </form>
                        <form method="POST" id="cetakcekbox" action="{{ url('cetak/penyerahanbox') }}" target="_blank">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-penyerahan">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="checkboxall" name="id[]" value="'. $data->id.'" class="custom-control-input checkbox" style="display:none;">
                                        <label for="checkboxall" class="toggle"><span></span></label>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th>Sms Notifikasi</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Kode Cetak</th>
                                    <th>Kode Box</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary" id="btnsumbit" style="position: relative;top: -65px;"><i class="fa fa-print"></i> Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $('#checkboxall').on('change', function () {
            $(".checkbox").prop('checked',$(this).is(":checked"));
            if($(this).is(":checked")){
                $('#btnsumbit').attr('disabled',false);
            }else{
                $('#btnsumbit').attr('disabled',true);
            }
        });

        $(document).ready(function () {
            $('#btnsumbit').attr('disabled',true);
        });

        
        function hideshow() {
            if($('.checkbox').is(":checked")){
                $('#btnsumbit').attr('disabled',false);
            }else{
                $('#btnsumbit').attr('disabled',true);
            }
        }

        $('#cetakcekbox').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                $('#data-penyerahan').dataTable().api().ajax.reload();
            }
        });

        $('#data-penyerahan').on('search.dt', function() {
            var value = $('.dataTables_filter input').val();
            $('#cetak').val(value);

        }); 

        $(document).on('change', "#status_update", function (e) {
            var id = $(this).data('id');
            var status_update = $(this).val();
            var tanggal1 = $('#tanggal1').val();
            var kd_box_update = $(this).closest('tr').find('#kd_box_update').val();
            swal({
                title: 'Validasi Perubahan Status Berkas!',
                text: "Jika status berkas dirubah, maka tidak dapat dikembalikan. Cek apakah akan mengubah Kode Box!",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'<i class="fa fa-check-circle"></i> Ya, Hapus ini',
                cancelButtonText: '<i class="fa fa-times-circle"></i> Batal'
            }).then(function(){        

                $.ajax({
                    url: "{{ url('penyerahanprosesstatus') }}",
                    type: "GET",
                    data: {id:id, status_update:status_update, kd_box_update:kd_box_update, tanggal1:tanggal1},
                    success:function(data){
                            $('#data-penyerahan').dataTable().api().ajax.reload();
                            $('div.flash-message').html(data);
                    },
                    error:function(){
                        alert("Error");
                    }
                });
            });
        })
        
        function editForm(id) {
            var tanggal1 = $('#tanggal1').val();
            $('input[name=_method]').val('PATCH');
            $("#form-penyerahanproses form").attr("action","{{ url('penyerahan') }}/"+id);
            $('#form-penyerahanproses form')[0].reset();
            $.ajax({
                url: "{{ url('penyerahan')}}/" + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#item_table').empty();
                    $('#id').val(data.id);
                    $('#no_berkas').val(data.no_berkas);
                    $('#nama1').val(data.nama1);
                    $('#email').val(data.email);
                    $('#status').val(data.status);
                    $('#kegiatan_id').val(data.kegiatan_id);
                    $('#kd_box').val(data.kd_box);
                    $('#kd_cetak2').val(data.kd_cetak);
                    $('#tanggal1').val(tanggal1);
                    if(data.catatan != null){
                        $('#catatan').val(data.catatan);
                        $('.catatan').text('*'+data.catatan);
                    }else{
                        $('#catatan').val('');
                        $('.catatan').text('');
                    }
                    $.each(data.penyerahandetail, function(k, v) {
                        var html = '';
                        html += '<tr>';
                        html += '<td><input type="text" name="no_hak[]" class="form-control" placeholder="Nomor Hak" value="'+v.no_hak+'" required/></td>';
                        html += '<td><select name="jenis_hak[]" class="form-control"><option value="'+v.jenis_hak+'">'+v.jenis_hak+'</option><option value="HM">HM</option><option value="HGB">HGB</option><option value="HGU">HGU</option><option value="HP">HP</option><option value="SRS">SRS</option></select></td>';
                        html += '<td><input type="text" name="desa[]" class="form-control" placeholder="Desa" value="'+v.desa+'" required/></td>';
                        html += '<td><input type="text" name="kecamatan[]" class="form-control" placeholder="Kecamatan" value="'+v.kecamatan+'"  required/></td>';
                        html += '<td><input type="text" name="no_warkah[]" class="form-control" placeholder="Nomor DI 208" value="'+v.no_warkah+'" required/></td>';
                        html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
                        html += '</tr>';
                        $('#item_table').append(html);
                    });
                }
            });
        }
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
                    url: "{{ url('penyerahan')}}/"+id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-penyerahan').dataTable().api().ajax.reload();
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
            $('#form-penyerahanproses form').validator().on('submit', function (e) {

            });
        });

        


        var Table;
        $(document).ready(function () {
            var Table;
            'use strict';
            Table = $('#data-penyerahan').DataTable({
                colReorder: true,
                processing: true,
                serverSide:true,
                ajax:"{{ url('api/penyerahan') }}",
                columns: [
                    {data: 'cekbox',name:'cekbox'},
                    {data: 'no_berkas',name:'no_berkas'},
                    {data: 'nama1',name:'nama1'},
                    {data: 'email',name:'email'},
                    {data: 'kegiatan.nama_kegiatan',name:'kegiatan.nama_kegiatan'},
                    {data: 'tanggal1',name:'tanggal1'},
                    {data: 'kd_cetak',name:'kd_cetak'},
                    {data: 'kd_box_update',name:'kd_box_update'},
                    {   
                        data: 'status_update',
                        name:'status_update',
                        searchable:false,
                       
                    },
                    {data: 'action',name:'action',orderable:false, searchable:false}
                ],
                 columnDefs: [ {
                    searchable: false,
                    orderable:false,
                    targets: 0
                } ],  
                order: [[ 5, 'desc' ]],
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
                iDisplayLength: 25
            }),
           
            yadcf.init(Table, [
                {
                    column_number: 2,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nama Pemohon"
                },
                 {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "Nomor Berkas"
                },
            ]);
            
            //  Table.on( 'draw.dt', function () {
            //     var PageInfo = $('#data-penyerahan').DataTable().page.info();
            //          Table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            //             cell.innerHTML = i + 1 + PageInfo.start;
            //         } );
            //     } );
           
        });
        function showcetak() {
            
        }
        
        function addData() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#form-panel").slideToggle();
        }

        function btnCancel(){
            location.reload();
        }

    </script>

@endpush
@endsection
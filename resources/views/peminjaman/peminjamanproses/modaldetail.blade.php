    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background:#222222">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Peminjaman <a id="namapeminjam"></a></h4>
            </div>
            <div class="modal-body" id="form-peminjamanprosesdetail">
                <form method="post" action="{{ url('peminjaman/proses/id') }}" data-toogle="validator" class="form-horzontal" id="form-detail">
                    {{csrf_field()}}
                    {{method_field ('PATCH')}} 
                    <input type="hidden" name="id" id="iddetail">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Nama Pemohon</label>
                                <input type="text" class="form-control" name="nama" id="namadetail" required > 
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">NIP</label>
                                <input type="number" class="form-control" name="nip" id="nipdetail">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Unit Kerja</label>
                                <input type="text" class="form-control" name="unit_kerja" id="unit_kerjadetail">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kegiatan</label>
                                <select class="form-control" name="kegiatan" id="kegiatandetail" required>
                                    <option value="1">Balik Nama</option>
                                    <option value="2">Blokir</option>
                                    <option value="3">Ganti Blanko</option>
                                    <option value="4">Hak Tanggungan</option>
                                    <option value="5">Lelang</option>
                                    <option value="6">Pembebanan Hak</option>
                                    <option value="7">Pembaharuan Hak</option>
                                    <option value="8">Pemisahan Hak</option>
                                    <option value="9">Pemohonan Hak</option>
                                    <option value="10">Penggabungan Hak</option>
                                    <option value="11">Peningkatan Hak</option>
                                    <option value="12">Penurunan Hak</option>
                                    <option value="13">Perpanjang Hak</option>
                                    <option value="14">Pengecekan</option>
                                    <option value="15">Roya Hak Tanggungan</option>
                                    <option value="16">Sertifikat Hilang</option>
                                    <option value="17">Sertifikat Rusak</option>
                                    <option value="18">Sengketa</option>
                                    <option value="19">Sita</option>
                                    <option value="20">SKP</option>
                                    <option value="21">SKPT</option>
                                    <option value="22">Splitching</option>
                                    <option value="23">Warisan</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Tanggal Pinjam</label>
                                <div class='input-group'>
                                    <input type='text' name="tanggal_pinjam" id="tanggal_pinjamdetail" class="form-control date" required/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Tanggal Kembali</label>
                                <div class='input-group'>
                                    <input type='text' name="tanggal_kembali" id="tanggal_kembalidetail" class="form-control date" required/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-detail">
                            <thead>
                                <tr>
                                    <th width="10%">Id Buku Tanah</th>
                                    <th width="10%">No.Hak</th>
                                    <th width="10%">Jenis Hak</th>
                                    <th width="15%">Desa </th> 
                                    <th width="15%">Kecamatan </th> 
                                    <th width="10%">No.Warkah</th>
                                    <th width="5%"><button type="button" name="add" class="btn btn-success adddetail"><i class="fa fa-plus text-white"></i></button></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-center">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan Perubahan</t></button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

@push('scripts')    
<script>
    

    $(document).ready(function(){
        $(document).on('click', '.adddetail', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="idbukutanah[]" id="idbukutanah'+i+'" data-type="idbukutanah" class="form-control autocomplete_detail" placeholder="ID Buku Tanah" /></td>';
        html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" /></td>';
        html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control" placeholder="Jenis Hak" /></td>';
        html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control" placeholder="Desa" /></td>';
        html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control" placeholder="Kecamatan" /></td>';
        html += '<td><input type="text" name="no_warkah[]" id="no_warkah'+i+'" class="form-control" placeholder="Nomor Warkah" /></td>';
        html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
        html += '</tr>';
        $('#form-detail #data-detail tbody').append(html);
        i++;
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });
    });

    var TableDetail;
    $(document).on("click", "#detailData", function () {
        $('#modal-form').modal('show');
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var nip = $(this).data('nip');
        var unitkerja = $(this).data('unitkerja');
        var kegiatan = $(this).data('kegiatan');
        var tanggalpinjam = $(this).data('tanggalpinjam');
        var tanggalkembali = $(this).data('tanggalkembali');

        $("#namapeminjam").text(nama);
        $("#iddetail").val(id);
        $("#namadetail").val(nama);
        $("#nipdetail").val(nip);
        $("#unit_kerjadetail").val(unitkerja);
        $("#kegiatandetail").val(kegiatan);
        $("#tanggal_pinjamdetail").val(tanggalpinjam);
        $("#tanggal_kembalidetail").val(tanggalkembali);

        var TableDetail;
        'use strict';
        TableDetail = $('#data-detail').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            "bDestroy": true,
            ajax:"{{ url('api/peminjamanproses') .'/'}}"+ id,
            columns: [
                {data: 'idbukutanah',name:'idbukutanah'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
                {data: 'no_warkah',name:'no_warkah'},
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
            {{-- iDisplayLength: 15 --}}
        })
        
    });
    function deleteDetail(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('peminjamandetail/proses')}}/" + id,
            type: "POST",
            data: {'_method': 'DELETE','_token': csrf_token
            },
            success: function(data) {
                $('#data-detail').dataTable().api().ajax.reload();
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
</script>
@endpush
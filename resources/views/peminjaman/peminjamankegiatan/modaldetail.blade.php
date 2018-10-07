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
                                <input type="text" class="form-control" name="nama" id="namadetail" required readonly > 
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">NIP</label>
                                <input type="number" class="form-control" name="nip" id="nipdetail" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Unit Kerja</label>
                                <input type="text" class="form-control" name="unit_kerja" id="unit_kerjadetail" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kegiatan</label>
                                    {{ Form::select('kegiatan', $kegiatan, request()->get('id'), ['id' => 'kegiatandetail', 'class' => 'form-control', 'required'=>'true','readonly'=>'true','disabled'=>'ture']) }}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name" class="control-label">Tanggal Pinjam</label>
                                <div class='input-group'>
                                    <input type='text' id="tanggal_pinjamdetail" name="tanggal_pinjam" class="form-control date" required readonly/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name" class="control-label">Tanggal Kembali</label>
                                <div class='input-group'>
                                    <input type='text' id="tanggal_kembalidetail" name="tanggal_kembali" class="form-control date"/>
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Peminjaman Via</label>
                                <input type="text" class="form-control" name="via" id="viadetail" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-detail">
                            <thead>
                                <tr>
                                    <th width="10%">Id Buku Tanah</th>
                                    <th width="10%"></th>
                                    <th width="10%">Jenis Hak</th>
                                    <th width="10%"></th> 
                                    <th width="10%">Kecamatan </th> 
                                    <th width="10%">No.Warkah</th>
                                    <th width="10%">No.SU</th>
                                    <th width="5%"></th>
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

@push('scripts')    
<script>
    
    $(document).on('click', "#cekdetail", function (e) {
        e.preventDefault();
        var id = $(this).data('id')
        var status_detail = $(this).data('value');
        var peminjaman_id = $(this).data('peminjaman_id');
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url: "{{ url('peminjamankegiatancekdetail')}}",
            type: "GET",
            data: {status_detail:status_detail, id:id,peminjaman_id:peminjaman_id},
                success: function (data) {
                $('#data-peminjaman').dataTable().api().ajax.reload();
                $('#data-detail').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
            },
                error: function () {
                alert('Oops! error!');
            }
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
        var via = $(this).data('via');

        $("#namapeminjam").text(nama);
        $("#iddetail").val(id);
        $("#namadetail").val(nama);
        $("#nipdetail").val(nip);
        $("#unit_kerjadetail").val(unitkerja);
        $("#viadetail").val(via);
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
            ajax:"{{ url('api/peminjamankegiatan') .'/'}}"+ id,
            columns: [
                {data: 'idbukutanah',name:'idbukutanah'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
                {data: 'no_warkah',name:'no_warkah'},
                {data: 'no_su',name:'no_su'},
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
        yadcf.init(TableDetail, [
                {
                    column_number: 1,
                    filter_type: "text",
                    filter_delay: 500,
                    filter_default_label: "No. Hak"
                },
                {
                    column_number: 3,
                    filter_type: "text",
                    filter_default_label: "Desa"
                }
            ]);
        
    });
    

    
</script>
@endpush
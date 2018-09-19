<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#222222">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Peminjaman <a id="namapeminjam"></a></h4>
            </div>
            <div class="modal-body" id="form-peminjamanprosesdetail">
                <form method="post" action="{{ url('pengembalian/id') }}" data-toogle="validator" class="form-horzontal" id="form-detail">
                    {{csrf_field()}}
                    {{method_field ('PATCH')}} 
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Id Buku Tanah</label>
                                <input type="text" class="form-control" name="idbukutanah" id="idbukutanah" required > 
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">No Hak</label>
                                <input type="number" class="form-control" name="no_hak" id="no_hak">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label">Jenis Hak</label>
                                <input type="text" class="form-control" name="jenis_hak" id="jenis_hak">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label">No Warkah</label>
                                <input type="number" class="form-control" name="no_warkah" id="no_warkah">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label">No SU</label>
                                <input type="number" class="form-control" name="no_su" id="no_su">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Desa</label>
                                <input type="text" class="form-control" name="desa" id="desa" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        
                        
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
    
        $(document).on("click", "#detailData", function () {
            $('#modal-form').modal('show');
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var idbukutanah = $(this).data('idbukutanah');
            var jenis_hak = $(this).data('jenis_hak');
            var desa = $(this).data('desa');
            var kecamatan = $(this).data('kecamatan');
            var no_warkah = $(this).data('no_warkah');
            var no_hak = $(this).data('no_hak');
            var no_su = $(this).data('no_su');
    
            $("#namapeminjam").text(nama);
            $("#id").val(id);
            $("#idbukutanah").val(idbukutanah);
            $("#jenis_hak").val(jenis_hak);
            $("#desa").val(desa);
            $("#kecamatan").val(kecamatan);
            $("#no_warkah").val(no_warkah);
            $("#no_hak").val(no_hak);
            $("#no_su").val(no_su);
            
        });

        

    
</script>
@endpush
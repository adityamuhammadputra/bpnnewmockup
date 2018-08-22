<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" data-toogle="validator" class="form-horzontal" id="form">
                {{csrf_field()}}
                {{method_field ('POST')}} 
                <div class="modal-header" style="background:#222222">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor Warkah</label>
                        <input type="text" class="form-control" name="no_warkah" id="no_warkah" required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Nomor Box</label>
                                <input type="text" class="form-control" name="no_box" id="no_box" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Tahun</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Lokasi Ruang</label>
                                <input type="text" class="form-control" name="lokasi_ruang" id="lokasi_ruang" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Posisi</label>
                                <input type="text" class="form-control" name="posisi" id="posisi" required>
                                <span class="help-block with-errors"></span>
                            </div>        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Rak</label>
                                <input type="text" class="form-control" name="rak" id="rak" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Baris</label>
                                <input type="text" class="form-control" name="baris" id="baris" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-save" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan"></t></button>
                </div>
            </form>
          </div>
        </div>
      </div>
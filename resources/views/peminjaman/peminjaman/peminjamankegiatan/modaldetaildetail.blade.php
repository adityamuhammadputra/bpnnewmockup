<div class="modal fade" id="modal-formdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="post" data-toogle="validator" class="form-horzontal" id="form">
                {{csrf_field()}}
                {{method_field ('PATCH')}} 
                <div class="modal-header" style="background:#222222">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">Edit Data</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="control-label">Id Buku Tanah</label>
                        <input type="text" class="form-control" name="idbukutanah" id="idbukutanah" >
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">No Hak</label>
                                <input type="text" class="form-control" name="no_hak" id="no_hak" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Jenis Hak</label>
                                <input type="text" class="form-control" name="jenis_hak" id="jenis_hak" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Desa</label>
                                <input type="text" class="form-control" name="desa" id="desa" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" required>
                                <span class="help-block with-errors"></span>
                            </div>        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">No Warkah</label>
                                <input type="text" class="form-control" name="no_warkah" id="no_warkah" >
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">No SU</label>
                                <input type="text" class="form-control" name="no_su" id="no_su">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-save" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
                </div>
            </form>
          </div>
        </div>
      </div>
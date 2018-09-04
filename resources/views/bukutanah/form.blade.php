<div id="form-pengecekan">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">No Hak</label>
                        <input type="text" class="form-control" name="no_hak" id="no_hak" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Jenis Hak</label>
                        <input type="text" class="form-control" name="jenis_cetak" id="jenis_cetak" required >
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Tahun</label>
                        <input type="text" class="form-control" name="tahun" id="tahun" required >
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div> 
           
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" required >
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Desa</label>
                        <input type="text" class="form-control" name="desa" id="desa" required >
                        <span class="help-block with-errors"></span>
                    </div>  
            </div>
        
        <div class="col-md-4">
            <div class="form-group">
                    <label for="name" class="control-label">Status</label>
                    <input type="text" class="form-control" name="status" id="status" required >
                    <span class="help-block with-errors"></span>
                </div>  
        </div>
    </div>
</div>
            <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
 </div>
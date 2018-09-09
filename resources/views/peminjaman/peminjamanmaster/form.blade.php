<div id="form-peminjamanmaster">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Id Buku Tanah</label>
                    <input type="text" class="form-control" name="id_buku_tanah" id="id_buku_tanah" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Jenis Hak</label>
                    <input type="text" class="form-control" name="jenis_hak" id="jenis_hak" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Nomor Hak</label>
                    <input type="text" class="form-control" name="no_hak" id="no_hak" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Desa</label>
                    <input type="text" class="form-control" name="desa" id="desa" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Kecamatan</label>
                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Keterangan</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">--Pilih Keterangan Fisik Berkas--</option>
                        <option value="1">Berkas Ada</option>
                        <option value="0">Berkas Tidak Ada</option>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>        
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
                <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
            </div>
        </div>
    </form>
 </div>
          

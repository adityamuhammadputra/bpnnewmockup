<div id="form-peminjamanproses">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Nama Pemohon</label>
                    <input type="text" class="form-control" name="nama" id="nama" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">NIK / NIP</label>
                    <input type="text" class="form-control" name="nik" id="nik" required>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Unit Kerja</label>
                    <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Kegiatan</label>
                    <select class="form-control" name="kegiatan" required>
                        <option value="1">Pengecekan</option>
                        <option value="2">Balik Nama</option>
                        <option value="3">Hak Tanggungan</option>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Kembali</label>
                    <input type="date" class="form-control" name="tanggal_kembali" id="tanggal_kembali" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
       
        <table class="table table-striped table-borderless" id="item_table">
            <thead>
                <tr>
                    <th width="30%">Id Buku Tanah</th>
                    <th width="10%">No.Hak</th>
                    <th width="10%">Jenis Hak</th>
                    <th width="15%">Desa </th> 
                    <th width="15%">Kecamatan </th> 
                    <th width="5%" style="text-align-center">
                        <button type="button" name="add" class="btn btn-success add"><i class="fa fa-plus text-white"></i></button>
                    </th>
                </tr>  
            </thead>
            {{--  <tbody>
                <tr>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger"> <i class="fa fa-minus"></i></button></td>
                </tr>
            </tbody>  --}}
        </table>
        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
</div>
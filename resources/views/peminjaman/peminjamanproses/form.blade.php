<div id="form-peminjamanproses">
    <form method="post" action="{{ url('peminjaman/proses') }}" data-toogle="validator" class="form-horzontal" id="form">
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
                    <label for="name" class="control-label">No Berkas</label>
                    <input type="number" class="form-control" name="nik" id="nik">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Unit Kerja</label>
                    <input type="text" class="form-control" name="unit_kerja" id="unit_kerja">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Kegiatan</label>
                    <select class="form-control" name="kegiatan" required>
                        <option value="Pengecekan">Pengecekan</option>
                        <option value="Balik Nama">Balik Nama</option>
                        <option value="Hak Tanggungan">Hak Tanggungan</option>
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
                        <input type='text' id="tanggalPinjam" name="tanggal_pinjam" class="form-control date" required/>
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
                        <input type='text' id="tanggalKembali" name="tanggal_kembali" class="form-control date" required/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
       
        <table class="table table-striped table-borderless" id="item_table">
            <thead>
                <tr>
                    <th width="15%">Id Buku Tanah</th>
                    <th width="10%">No.Hak</th>
                    <th width="10%">Jenis Hak</th>
                    <th width="15%">Desa </th> 
                    <th width="15%">Kecamatan </th> 
                    <th width="5%" style="text-align-center">
                        <button type="button" name="add" class="btn btn-success add"><i class="fa fa-plus text-white"></i></button>
                    </th>
                </tr>  
            </thead>
             <tbody>
               
            </tbody> 
        </table>
        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var dateNow = new Date();
        var dateNext = new Date();
        $(function() {
            dateNext.setDate(dateNext.getDate() + 7);
            $('#tanggalPinjam').datetimepicker({
                defaultDate:dateNow
            });

            $('#tanggalKembali').datetimepicker({
                defaultDate:dateNext
            });
        });
    });
        
</script>
@endpush

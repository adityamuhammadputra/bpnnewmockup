<div id="form-peminjamanmaster">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Id Buku Tanah</label>
                    <input type="text" class="form-control" name="idbukutanah" id="idbukutanah" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">No Bundel</label>
                    <input type="text" class="form-control" name="no_box" id="no_box" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Jenis Hak</label>
                    <input type="text" class="form-control" name="jenis_hak" id="jenis_hak" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Nomor Hak</label>
                    <input type="text" class="form-control" name="no_hak" id="no_hak" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
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
        </div>
     <div class="row">
          <div class="col-md-2">
                <div class="form-group">
                    <label for="name" class="control-label">Rak</label>
                    <input type="number" class="form-control" name="rak" id="rak" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
             <div class="col-md-2">
                <div class="form-group">
                    <label for="name" class="control-label">Baris</label>
                    <input type="number" class="form-control" name="baris" id="baris" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Ruang</label>
                    <select name="ruang" id="ruang" class="form-control">
                        <option value="">--Pilih Penyimpanan--</option>
                        <option value="ROBOTIC">Robotic</option>
                        <option value="RAK">Rak</option>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>        
            </div>
        <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Keterangan</label>
                    <select name="status_pinjam" id="status" class="form-control" readonly>
                        <option value="0">Berkas Tersedia</option>
                        <option value="1" selected>Berkas Sedang Dipinjam</option>
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

 @push('scripts')
    <script>
        $(document).ready(function() {
        src = "{{ url('autocompletepeminjamanmaster') }}";
        $("#idbukutanah").autocomplete({
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
                var idbukutanah =ui.item.id;
                $.ajax({
                    type: "GET",
                    url: "{{ url('autocompletepeminjamanmastershow')}}",
                    data : {
                        idbukutanah : idbukutanah
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();   
                    },
                    success: function(data){
                        var datashow = JSON.parse(data); 
                        $("#no_box").val(datashow[0].no_box);
                        $("#idbukutanah").val(datashow[0].idbukutanah);
                        $("#jenis_hak").val(datashow[0].jenis_hak);
                        $("#no_hak").val(datashow[0].no_hak);
                        $('#desa').val(datashow[0].desa);
                        $('#kecamatan').val(datashow[0].kecamatan);

                    }
                });
            },
            minLength: 2,
        });
    }); 
    </script>
 @endpush
          

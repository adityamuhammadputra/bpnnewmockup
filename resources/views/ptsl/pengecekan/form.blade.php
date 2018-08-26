 <div id="form-pengecekan">
    <form method="post" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor Berkas</label>
                        <input type="text" class="form-control" name="no_berkas" id="no_berkas" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Nomor Hak</label>
                        <input type="text" class="form-control" name="no_hak" id="no_hak" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Di 208</label>
                        <input type="text" class="form-control" name="no_208" id="no_208" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">No Surat Ukur</label>
                        <input type="text" class="form-control" name="no_su" id="no_su" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Tahun</label>
                        <input type="text" class="form-control" name="tahun" id="tahun" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Pemegang</label>
                        <input type="text" class="form-control" name="pemegang" id="pemegang" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>        
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Desa</label>
                        <input type="text" class="form-control" name="desa" id="desa" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" required readonly>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">No Box</label>
                        <input type="text" class="form-control" name="no_box" id="no_box" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Ruang</label>
                        <input type="text" class="form-control" name="ruang" id="ruang" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Rak</label>
                        <input type="text" class="form-control" name="rak" id="rak" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Baris</label>
                        <input type="text" class="form-control" name="baris" id="baris" required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="control-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi" id="posisi" required>
                        
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
 </div>
          

@push('scripts')
<script>
        $(document).ready(function() {
            src = "{{ route('pengecekan.autocomplete') }}";
            $("#no_berkas").autocomplete({
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
                    var no_berkas =ui.item.id;
                    $.ajax({
                        type: "GET",
                        url: "{{route('pengecekan.showptsl')}}",
                        data : {
                            no_berkas : no_berkas
                        },
                        cache: false,
                        dataType: "html",
                        beforeSend  : function(){
                            $(".prosesloading").show();   
    
                        },
                        success: function(data){
                            var datashow = JSON.parse(data); 
                            $("#no_berkas").val(datashow[0].no_berkas);
                            $("#no_hak").val(datashow[0].no_hak);
                            $("#no_208").val(datashow[0].no_208);
                            $("#no_su").val(datashow[0].no_su);
                            $("#tahun").val(datashow[0].tahun);
                            $("#pemegang").val(datashow[0].pemegang);
                            $("#desa").val(datashow[0].desa);
                            $("#kecamatan").val(datashow[0].kecamatan);
                            
                        }
                    });
                },
                minLength: 2,
            });
        }); 
        //endautocomplte
</script>
@endpush
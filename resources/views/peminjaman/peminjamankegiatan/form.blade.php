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
                    <label for="name" class="control-label">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip">
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

                    {{ Form::select('kegiatan', $kegiatan, request()->get('id'), ['id' => 'kegiatan', 'class' => 'form-control', 'required'=>'true']) }}

                        
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Peminjaman Via</label>
                    <input type="text" class="form-control" name="via" id="via">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
       
        
        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Cetak</t></button>
    </form>
</div>
@push('scripts')
<script type="text/javascript">

    

    $(document).ready(function() {
        src = "{{ url('autocompletepegawai') }}";
        $("#nama").autocomplete({
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
                var nip =ui.item.id;
                $.ajax({
                    type: "GET",
                    url: "{{ url('autocompletepegawaishow')}}",
                    data : {
                        nip : nip
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();   

                    },
                    success: function(data){
                        var datashow = JSON.parse(data); 
                        $("#nama").val(datashow[0].nama);
                        $("#nip").val(datashow[0].nip);
                        $("#unit_kerja").val(datashow[0].unit_kerja);
                        $('#kegiatan').val(datashow[0].kegiatan_id);
                    }
                });
            },
            minLength: 2,
        });
    }); 
   
</script>
@endpush

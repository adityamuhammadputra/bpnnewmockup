<div id="form">
    <form method="POST" data-toogle="validator" action="{{ url('cetak/penyerahanhistory') }}" class="form-horzontal" id="form" target='_blank'>
        {{csrf_field()}}
        {{method_field ('POST')}}
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Awal</label>
                    <div class='input-group'>
                        <input type='text' id="tanggalPinjam" name="tanggal_awal" class="form-control date" required/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Akhir</label>
                    <div class='input-group'>
                        <input type='text' id="tanggalKembali" name="tanggal_akhir" class="form-control date" required/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select name="status_cetak" class="form-control">
                        <option value="">---Pilih Status---</option>
                        <option value="1">Sudah Diserahkan</option>    
                        <option value="2">Belum Diserahkan</option>    
                    </select>                                              
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> <t class="tombol-simpan">Cetak</t></button>
                    <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
                </div>
            </div>
        </div>
       
    </form>
</div>
@push('scripts')
<script type="text/javascript">
    $('#form-panel').hide();

    function addData() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $("#form-panel").slideToggle();
    }

    function btnCancel(){
        $('#form-panel form')[0].reset();
        $("#form-panel").slideUp();
    }
   
    $(document).ready(function() {
        // var dateNow = new Date();
        // var dateNext = new Date();
        $(function() {
            // dateNext.setDate(dateNext.getDate() + 14);
            $('#tanggalPinjam').datetimepicker({
                viewMode: 'days',
                format: 'DD/MM/YYYY'
            });

            $('#tanggalKembali').datetimepicker({
                viewMode: 'days',
                format: 'DD/MM/YYYY'
            });
        });

        $('#tanggalKembali').on('blur', function () {
            var cektanggal = $(this).val();
            if(cektanggal < $('#tanggalPinjam').val()){
                alert('Jika tanggal akhir kurang dari tanggal awal, Maka data mungkin kosong');
            }
        })
    });

    $(function () {
        $('#form-panel form').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                $.ajax({
                    url:"{{ url('penyerahanhistory') }}",
                    type:"GET",
                    data: {a:'a'},
                    success: function (data) {
                        $('#data-penyerahan').dataTable().api().ajax.reload();
                    },
                    error: function () {
                        alert("terjadi error, Coba untuk relaod");
                    }
                })
            }
        })
    })
    

    //  
        
</script>
@endpush

<style>
.catatan,.catatanmax{
    font-size: 14px;
    font-weight: 400;
    float: right;
}
.catatanmax{
    color: #999;
    padding-top: 3px;
}
</style>
<div id="form-penyerahanproses">
    <form method="post" action="{{ url('penyerahan') }}" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-4">
                 <div class="form-group">
                    <label for="" class="control-label">Nomor Berkas</label>
                    <input type="text" class="form-control" name="no_berkas" id="no_berkas" required >
                    <span class="help-block with-errors"></span>
                </div>
                
                <div class="form-group">
                    <label for="" class="control-label">Nama Pemohon</label>
                    <input type="text" class="form-control" name="nama1" id="nama1" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="control-label">Sms Notifikasi</label>
                    <input type="number" class="form-control" name="email" id="email" autocomplete="off">
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label class="control-label">Status</label><a class="catatan"></a>
                    <select  class="form-control" name="status" id="status">
                        <option value="3" name="selesai">Berkas Selesai</option>
                        <option value="2" name="revisi">Berkas Tidak Lengkap</option>
                        <option value="1" name="tunggakan">Berkas Tunggakan</option>
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Jenis Permohonan</label>
                            <select name="kegiatan_id" id="kegiatan_id" required class="form-control">
                                @foreach ($kegiatan as $value => $key)
                                    <option value="{{ $value }}" @if ($value == Auth::user()->kegiatan_penyerahan_id) selected @endif>{{ $key }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Kode Box</label>
                              <select name="kd_box" id="kd_box" class="form-control">
                                  @foreach ($kodebox as $value => $label)
                                    <option value="{{ $value }}" @if (old('kd_box') == $value) selected @endif >{{ $label }}</option>
                                  @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $no_urut }}" name="no_urut">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Kode Cetak</label>
                            <input type="hidden" class="form-control" id="kd_cetak1" value="{{ $kd_cetak }}">
                            <input type="text" name="kd_cetak" class="form-control" id="kd_cetak2" value="{{ $kd_cetak }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal</label>
                    <div class='input-group'>
                        <input type='text' id="tanggal1" name="tanggal1" class="form-control date" readonly required/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
                
                
            </div>
        </div>
                         
        <div class="table-responsive">
        <table class="table table-striped table-borderless" id="item_table">
            <thead>
                <tr class="hidden-xs">
                    <th width="10%">No.Hak</th>
                    <th width="10%">Jenis Hak</th>
                    <th width="10%">Desa </th> 
                    <th width="10%">Kecamatan </th> 
                    <th width="10%">No.DI 208</th>
                    <th width="5%" style="text-align-center">
                        <button type="button" name="add" class="btn btn-success add"><i class="fa fa-plus text-white"></i></button>
                    </th>
                </tr>
                <tr class="visible-xs">
                    <th>Nomor Hak</th>
                    <th>Jenis Hak</th>
                    <th>Nama Desa </th> 
                    <th>Kecamatan </th> 
                    <th>No.DI 208</th>
                    <th width="5%" style="text-align-center">
                        <button type="button" name="add" class="btn btn-success add"><i class="fa fa-plus text-white"></i></button>
                    </th>
                </tr>    
            </thead>
             <tbody>
               
            </tbody> 
        </table>
</div>
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background:#222222">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-title">Form Catatan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Tambah Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" maxlength="30"></textarea>
                            <label class="control-label catatanmax">* Maksimal 30 karakter</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="batalCatatan()"><i class="fa fa-times-circle"></i> Batal</button>
                        <button type="button" class="btn btn-primary" onclick="simpanCatatan()"><i class="fa fa-check-circle"></i> Simpan Catatan</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>



    
@push('scripts')
<script type="text/javascript">
    $("#status").on("change",function () {
         var status = $("#status").val();
         var kd_cetak = $("#kd_cetak1").val();
        if(status == 2){
            $('#modal-form').modal('show');
            $('#kd_cetak2').val('');
        }else if(status == 1){
            $('#kd_cetak2').val('');
        }
        else{
            $('#catatan').val('');
            $('.catatan').text('');
            $('#kd_cetak2').val(kd_cetak);
        }

    })

    function simpanCatatan() {
        var catatan = $('#catatan').val();
        $('.catatan').text('* '+catatan);
        $('#modal-form').modal('hide');
    }

    function batalCatatan() {
        $('#catatan').val('');
        $('.catatan').text('');
        $('#modal-form').modal('hide');
    }
   
    var i=$('table tr').length;

    $(document).ready(function(){
        $(document).on('click', '.add', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" required/></td>';
        // html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control" placeholder="Jenis Hak" /></td>';
        html += '<td><select name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control"><option value="HM">HM</option><option value="HGB">HGB</option><option value="HGU">HGU</option><option value="HP">HP</option><option value="SRS">SRS</option></select></td>';
        html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control" placeholder="Desa"required /></td>';
        html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control" placeholder="Kecamatan" required/></td>';
        html += '<td><input type="text" name="no_warkah[]" id="no_warkah'+i+'" class="form-control" placeholder="Nomor DI 208" required/></td>';
        html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
        html += '</tr>';
        $('#item_table').append(html);
        i++;
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });
    });

  

    $(document).ready(function() {
        var dateNow = new Date();
        $(function() {
            $('#tanggal1').datetimepicker({
                defaultDate:dateNow
            });
           
        });
    });

    $('#kegiatan').change(function(){
        
     });
        
</script>
@endpush

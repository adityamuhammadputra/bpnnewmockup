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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Jenis Permohonan</label>
                            {{ Form::select('kegiatan_id', $kegiatan, request()->get('id'), ['id' => 'kegiatan_id', 'class' => 'form-control', 'required'=>'true']) }}
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Kode Box</label>
                              <select name="kd_box" id="kd_box" class="form-control">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="control-label">Nomor Notifikasi</label>
                    <input type="email" class="form-control" name="email" id="email" value="6288225872452" readonly >
                    <span class="help-block with-errors"></span>
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">Tanggal Selesai</label>
                    <div class='input-group'>
                        <input type='text' id="tanggal1" name="tanggal1" class="form-control date" readonly required/>
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                    <span class="help-block with-errors"></span>
                </div>
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <input type="text" class="form-control" name="status" id="status" value="Siap Diserahkan" readonly required>
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
                    <th width="10%">No.DI 208</th>
                    <th width="10%">Tahun</th>
                    <th width="10%">Desa </th> 
                    <th width="10%">Kecamatan </th> 
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
    // $('#kegiatan').on('change',function () {
    //     alert(this.value);
    // })
    var i=$('table tr').length;

    $(document).ready(function(){
        $(document).on('click', '.add', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="idbukutanah[]" id="idbukutanah'+i+'" data-type="idbukutanah" class="form-control autocomplete_txt" placeholder="Id Buku Tanah" /></td>';
        html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" /></td>';
        html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control" placeholder="Jenis Hak" /></td>';
        html += '<td><input type="text" name="no_warkah[]" id="no_warkah'+i+'" class="form-control" placeholder="Nomor DI 208" /></td>';
        html += '<td><input type="text" name="tahun[]" id="tahun'+i+'" class="form-control" placeholder="Tahun" /></td>';
        html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control" placeholder="Desa" /></td>';
        html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control" placeholder="Kecamatan" /></td>';
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

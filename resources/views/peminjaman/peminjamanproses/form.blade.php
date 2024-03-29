<div id="form-peminjamanproses">
    <form method="post" action="{{ url('peminjaman/proses') }}" data-toogle="validator" class="form-horzontal" id="form">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">Nama Peminjam</label>
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
                    <label for="name" class="control-label">Tanggal Jatuh Tempo</label>
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
                    
                    {{-- <select name="via" id="via" class="form-control">
                        <option selected disabled>-- Peminjaman Via --</option>
                    </select> --}}
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
       
        <table class="table table-striped table-borderless" id="item_table">
            <thead>
                <tr>
                    <th width="15%">Id Buku Tanah</th>
                    <th width="10%">No.Hak</th>
                    <th width="10%">Jenis Hak <input type="checkbox" name="" id="samakan-jenishak"></th>
                    <th width="10%">Desa  <input type="checkbox" name="" id="samakan-desa"></th> 
                    <th width="10%">Kecamatan <input type="checkbox" name="" id="samakan-kecamatan"> </th> 
                    <th width="10%">No.Warkah</th>
                    <th width="10%">No.SU</th>
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
    
    $('#samakan-jenishak').on('click',function () {
        var jenis_hak = $('#item_table tr input.jenishak:first').val();
        if($(this).prop('checked')){
            $('.jenishak').val(jenis_hak);
        }
        else{
            $('.jenishak').val('');
        }
    })
    
    $('#samakan-desa').on('click',function () {
        var desa = $('#item_table tr input.desa:first').val();
        if($(this).prop('checked')){
            $('.desa').val(desa);
        }
        else{
            $('.desa').val('');
        }
    })
     $('#samakan-kecamatan').on('click',function () {
        var kecamatan = $('#item_table tr input.kecamatan:first').val();
        if($(this).prop('checked')){
            $('.kecamatan').val(kecamatan);
        }
        else{
            $('.kecamatan').val('');
        }
    })

    var i=$('table tr').length;

    $(document).ready(function(){
        $(document).on('click', '.add', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="idbukutanah[]" id="idbukutanah'+i+'" data-type="idbukutanah" class="form-control autocomplete_txt" placeholder="Cari Buku Tanah" /></td>';
        html += '<td><input type="text" name="no_hak[]" id="no_hak'+i+'" class="form-control" placeholder="Nomor Hak" /></td>';
        html += '<td><input type="text" name="jenis_hak[]" id="jenis_hak'+i+'" class="form-control jenishak" placeholder="Jenis Hak" /></td>';
        html += '<td><input type="text" name="desa[]" id="desa'+i+'" class="form-control desa" placeholder="Desa" /></td>';
        html += '<td><input type="text" name="kecamatan[]" id="kecamatan'+i+'" class="form-control kecamatan" placeholder="Kecamatan" /></td>';
        html += '<td><input type="text" name="no_warkah[]" id="no_warkah'+i+'" class="form-control" placeholder="Nomor Warkah" /></td>';
        html += '<td><input type="text" name="no_su[]" id="no_su'+i+'" class="form-control" placeholder="Nomor SU / Nomor HT" /></td>';
        html += '<td><button type="button" name="remove" class= "btn btn-danger remove"><i class="fa fa-minus"></i></button></td>';
        html += '</tr>';
        $('#item_table').append(html);
        i++;
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });
    });

    $(document).on('focus','.autocomplete_txt',function(){
        type = $(this).data('type');
        if(type =='idbukutanah' )autoType='idbukutanah'; 
        src = "{{ route('peminjaman.proses.autocomplete') }}";
        $(this).autocomplete({
            minLength: 0,
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term,
                        type : type,
                    },
                    success: function(data) {
                        var array = $.map(data, function (item) {
                            return {
                                label: item[autoType],
                                value: item[autoType],
                                data : item.id
                            }
                        });
                        response(array)
                    }
                }); 
            },
            select: function( event, ui ) {
                id_arr = $(this).attr('id');
                elementId = id_arr.substring(11);
                var data = ui.item.data; 
                console.log(elementId);
                $.ajax({
                    type: "GET",
                    url: "{{route('peminjaman.proses.autocomplete.show')}}",
                    data : {
                        idbukutanah : data
                    },
                    cache: false,
                    dataType: "html",
                    beforeSend  : function(){
                        $(".prosesloading").show();   
                    },
                    success: function(data){
                        var datashow = JSON.parse(data);
                        console.log(id_arr); 
                        $("#idbukutanah" + elementId).val(datashow[0].idbukutanah);
                        $("#no_hak" + elementId).val(datashow[0].no_hak);
                        $("#jenis_hak" + elementId).val(datashow[0].jenis_hak);
                        $("#desa" + elementId).val(datashow[0].desa);
                        $("#kecamatan" + elementId).val(datashow[0].kecamatan);
                    }
                });
            },
            minLength: 3,
        });
    });

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
                        // $('#via').val(datashow[0].kegiatan_id);
                        // var peminjaman_id = datashow[0].kegiatan_id;
                        // if(peminjaman_id){
                        //     $.ajax({
                        //         type:"GET",
                        //         url:"{{url('api/via')}}?peminjaman_id="+peminjaman_id,
                        //         success:function(res){
                        //             if(res){
                        //                 $("#via").empty();
                        //                 $("#via").append('<option selected disabled>-- Peminjaman Via --</option>');
                        //                 $.each(res,function(key,value) {
                        //                     $("#via").append('<option value="'+key+'">'+value+'</option>');
                        //                 });
                        //             }else{
                        //                 $("#via").empty();

                        //             }
                        //         }
                        //     });
                        // }
                        // else{
                        //     $("#via").empty();
                        // }
                        var kegiatan = datashow[0].kegiatan_id;
                        if(kegiatan == 4){
                            
                        }
                    }
                });
            },
            minLength: 2,
        });
    }); 
    $(document).ready(function() {
        var dateNow = new Date();
        var dateNext = new Date();
        $(function() {
            dateNext.setDate(dateNext.getDate() + 14);
            $('#tanggalPinjam').datetimepicker({
                defaultDate:dateNow
            });

            $('#tanggalKembali').datetimepicker({
                defaultDate:dateNext
            });
        });
    });

    $('#kegiatan').change(function(){
        
     });
        
</script>
@endpush

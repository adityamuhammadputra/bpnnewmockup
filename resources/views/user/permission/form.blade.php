<div id="form">
    <form method="post" action="{{ url('userpermission') }}" data-toogle="validator" class="form-horzontal">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="" class="control-label">Nama Permission</label>
                    <input type="text" class="form-control" name="name" id="name" required >
                    <span class="help-block with-errors"></span>
                </div>
                
                <div class="form-group">
                    <label for="" class="control-label"> Guerd Name</label>
                    <input type="text" class="form-control" name="guard_name" id="guard_name" value="web" readonly required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="col-md-6">
                <br>
                <div class="alert alert-info">
                    <strong>Petunjuk Pengisian !</strong>
                    <ul>
                        <li>Uer Role adalah nama dari akses</li>
                        <li>Contoh Nama role: admin, staf peminjaman, staf pengembalian, staf penyerahan dan lain-lain </li>
                        <li>Guard Name dibiarkan default web</li>
                        <li>Permission adalah hak akses apa saja yang diberikan kepada User Role Tersebut</li>
                    </ul>
                </div>
            </div>
            
        </div>

        
       
        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
</div>
@push('scripts')
    <script>
        
    </script>
@endpush

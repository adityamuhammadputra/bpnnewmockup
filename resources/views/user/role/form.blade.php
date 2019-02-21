<div id="form">
    <form method="post" action="{{ url('userrole') }}" data-toogle="validator" class="form-horzontal">
        {{csrf_field()}}
        {{method_field ('POST')}} 
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="" class="control-label">Nama Role</label>
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

        <br>
        <div class="row" style="padding-left: 40px;">
            @foreach ($data as $permission)
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}" id="cekbox{{ $permission->id }}" class="inp-cbx checkbox" style="display: none;">
                        <label class="cbx" for="cekbox{{ $permission->id }}"><span>
                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                        </svg></span><span></span>
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        <button type="button" class="btn btn-default" onclick="btnCancel()"><i class="fa fa-times-circle"></i> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> <t class="tombol-simpan">Simpan</t></button>
    </form>
</div>
@push('scripts')
    <script>
        function btnCancel()
        {
            $('#id').val('');
            $('#name').val('');
            $('.checkbox').attr('checked',false);
        }
    </script>
@endpush

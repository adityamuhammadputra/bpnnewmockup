<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
      
            <form method="post" data-toogle="validator" class="form-horzontal" id="form" enctype="multipart/form-data">
              {{csrf_field()}}
              {{method_field ('POST')}} 
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title" style="color:black;">User dan Akses</h4>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="name" class="control-label">Nama</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                  <span class="help-block with-errors"></span>
                </div>
      
                <div class="form-group">
                  <label for="email" class="control-label">Username</label>
                  <input type="username" name="email" id="email" class="form-control" required>
                  <span class="help-block with-errors" id="usernameerror"></span>            
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="text" name="password" id="password" class="form-control">
                    <span class="help-block with-errors"></span>            
                </div>
                <div class="form-group">
                    <label for="passwordagain" class="control-label">Konfirmasi Password Baru</label>
                    <input type="password" name="" id="passwordagain" data-match="#password" data-match-error="Password tidak cocok" class="form-control">
                    <span class="help-block with-errors"></span>            
                </div>
                 <div class="form-group">
                  <label for="foto" class="control-label">Foto</label>
                  <input type="file" name="photo" id="photo" class="form-control">
                  <span class="help-block with-errors"></span>            
                </div>
                <label for="password" class="control-label">Hak Akses / Role</label> <br>

                @foreach ($data as $role)

                <div class="col-md-4">
                    <div class="form-group">
                      <input type="checkbox" name="role[]" value="{{ $role->name }}" id="cekbox{{ $role->id }}" class="inp-cbx checkbox" style="display: none;">
                        <label class="cbx" for="cekbox{{ $role->id }}"><span>
                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                        </svg></span><span></span>
                            {{ $role->name }}
                        </label>
                    </div>
                  </div>
                @endforeach
                <br><br><br>
                <br><br><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-save" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>

@push('scripts')
<script>
    $('#password').blur(function () {
        if($(this).val()){
            $('#passwordagain').attr('required',true);
        }else{
            $('#passwordagain').attr('required',false);
        }
    })


    $('#email').blur(function () {
        var email = $(this).val().replace(/[^A-Z0-9]/ig, "");
        $('#email').val(email);
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('editprofile/cekusers') }}",
            method: "POST",
            data:{email:email,_token:_token},
            success: function (data) {
                if(data == 'ada'){
                    $('#usernameerror').html('');
                    $('#usernameerror').append('<a class="text-danger"><i class="fa fa-stop-circle-o"></i> Username sudah digunakan</a>');
                    $('.form-username').addClass('has-error has-danger');
                    $('#simpan').attr('disabled', true);
                }
                else{
                    $('#usernameerror').html('');
                    $('#usernameerror').append('<a class="text-success"><i class="fa fa-check-circle-o"></i> Username dapat digunakan</a>');
                    $('#simpan').attr('disabled', false);
                }
                
            }
        });
    })
  </script>
@endpush

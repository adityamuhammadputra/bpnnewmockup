@extends('layouts.master')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-users"></em>
            </a></li>
            <li class="active">User</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile User <a href="#">{{ Auth::user()->name }}</a>
                </div>
                <div class="panel-body" id="form">
                    <form method="post" data-toogle="validator" class="form-horzontal" action="{{ url('editprofile', $id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                     <div class="form-group">
                                        <label for="name" class="control-label">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                        
                                    <div class="form-group form-username">
                                        <label for="email" class="control-label">Username</label>
                                        <input type="username" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                        <span class="help-block with-errors" id="usernameerror"></span>            
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label">Profile Akses</label>
                                        <input type="text" name="jabatan_profile" id="jabatan_profile" class="form-control" value="{{ Auth::user()->jabatan_profile }}" required>
                                        <span class="help-block with-errors"></span>            
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password Baru</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <span class="help-block with-errors"></span>            
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Konfirmasi Password Baru</label>
                                        <input type="password" name="" id="passwordagain" data-match="#password" data-match-error="Password tidak cocok" class="form-control">
                                        <span class="help-block with-errors"></span>            
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="control-label">Foto Profile</label>
                                    <img src="{{ asset(auth()->user()->photo) }}" class="img img-responsive" id="photos">
                                    <label for="files" class="btn btn-default form-control"><i class="fa fa-cloud-upload"></i> Upload Foto</label>
                                    <input type="file" id="files" name="photo" style="visibility:hidden;" accept=".png, .jpg, .jpeg" class="btn btn-default form-control">
                                </div>

                                <div class="col-md-4">
                                    <div class="alert alert-info">
                                        <strong>Petunjuk Pengisian !</strong>
                                        <ul>
                                            <li>Ukuran foto maximal 2MB</li>
                                            <li>Username tidak boleh mengandung spaci dan spesial karakter</li>
                                            <li>Username tidak boleh sama dengan akun lain</li>
                                            <li>Password dan Konfirmasi password harus sama</li>
                                            <li>Profile akses adalah nama hak akses anda</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        <div class="row">
                            <div class="col-md-12 text-center">
                                  <button type="submit" class="btn btn-primary" id="simpan">Simpan Perubahan</button>
                                  <a href="javascript:window.location.href=window.location.href" class="btn btn-default">Batal</a>
                            </div>
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

     $(function () {
            $('#form form').validator().on('submit', function (e) {

            });
        });


    function readURL(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
                reader.onload = function(e) {
                    $('#photos').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#files").change(function() {
        readURL(this);
    });
</script>
@endpush
@endsection


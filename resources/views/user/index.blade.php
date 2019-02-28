@extends('layouts.master')

@section('content')
{{-- <div class="container-fluid"> --}}
    <!-- Start Page Content -->
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
                    Master Data User 
                    <div class="pull-right">
                        <span class="clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <button class="btn btn-primary pull-right btn-flat" onclick="addForm()"><i class="fa fa-plus-circle"></i> Tambah User</button>
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover table-striped table-borderless table-responsive" id="data-user">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Akses</th>
                                    <th>photo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    @include('user.form')

    <!-- End PAge Content -->
{{-- </div> --}}
@push('scripts')
    <script>
        $('#data-user').DataTable({
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            processing: true,
            serverSide:true,
            ajax:"{{ route('api.user') }}",
            columns: [
                {data: 'name',name:'name'},
                {data: 'email',name:'email'},
                {data: 'akses', name:'akses'},
                {data: 'show_photo',name:'show_photo'},
                {data: 'action',name:'action',orderable:false, searchable:false}
            ]
        });

        
        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            {{-- $('#modal-form form')[0].reset(); --}}
            $('.modal-title').text('Tambah User Baru');
        }


        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('user')}}/" + id + "/edit", //menampilkan data dari controller edit
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit User');

                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $.each(data.roles, function( key, value) {
                        $('#cekbox'+value.id).attr('checked','checked');
                    });

                },

                error: function () {
                    alert("Data tidak ada");
                }

            });
        }

        //add data dan edit
        $(function () {
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('user') }}"; 
                    else url = "{{ url('user') . '/'}}" + id;
                    $.ajax({
                        url: url,
                        type: "POST",
                        // data: $('#modal-form form').serialize(),
                        data:new FormData($('#modal-form form')[0]),
                        contentType: false,
                        processData: false,
                                            
                        success: function ($data) {
                            $('#modal-form').modal('toggle');
                            $('#data-user').dataTable().api().ajax.reload();
                            swal({
                                title:'Succes!',
                                text: 'Berhasil',
                                type:'success',
                                timer: 2000
                            })
                        },
                        error: function () {
                            alert('Oops! error!');
                            swal({
                                title:'Oops...',
                                text: 'error',
                                type:'error',
                                timer: 2000

                            })
                        }
                    });
                    return false;
                }
            });
        });



        function deleteData(id) {
            // var popup = confirm("apakah anda yakin akan menghapus data?");
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Apakah Anda akan menghapus data ?',
                text: "Confirmasi Penghapus Data!",
                type:'warning',
                showCancelButton:true,
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                confirmButtonText:'Ya, Hapus!'
            }).then(function(){                
                $.ajax({
                    url: "{{ url('user')}}/" + id,
                    type: "POST",
                    data: {'_method': 'DELETE','_token': csrf_token
                    },
                    success: function(data) {
                        $('#data-user').dataTable().api().ajax.reload();
                        swal({
                            title:'Success!',
                            text: 'Berhasil ',
                            type:'success',
                            timer:2000
                        })
                    },
                    error: function () {
                        swal({
                            title:'opss..',
                            text: 'Maaf error',
                            type:'error',
                            timer: 2000
                        })
                    }
                });
            });

        }

    </script>
@endpush
    
@endsection
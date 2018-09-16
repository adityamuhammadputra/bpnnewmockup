    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background:#222222">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Peminjaman <a id="namapeminjam"></a></h4>
            </div>
            <div class="modal-body" id="form-peminjamanprosesdetail">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-borderless table-responsive" id="data-detail">
                        <thead>
                            <tr>
                                <th width="10%">Id Buku Tanah</th>
                                <th width="10%">No.Hak</th>
                                <th width="10%">Jenis Hak</th>
                                <th width="15%">Desa </th> 
                                <th width="15%">Kecamatan </th> 
                                <th width="10%">No.Warkah</th>
                                <th width="10%">Keterangan</th>
                                <th width="3%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>

@push('scripts')    
<script>
    
    $(document).on('click', "#cekdetail", function (e) {
        e.preventDefault();
        var id = $(this).data('id')
        var status_detail = $(this).data('value');
        var peminjaman_id = $(this).data('peminjaman_id');
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            url: "{{ url('pengembaliancekdetail')}}",
            type: "GET",
            data: {status_detail:status_detail, id:id,peminjaman_id:peminjaman_id},
                success: function (data) {
                $('#data-detail').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
            },
                error: function () {
                alert('Oops! error!');
            }
        });
    });

    var TableDetail;
    $(document).on("click", "#detailData", function () {
        $('#modal-form').modal('show');
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        

        var TableDetail;
        'use strict';
        TableDetail = $('#data-detail').DataTable({
            colReorder: true,
            processing: true,
            serverSide:true,
            "bDestroy": true,
            ajax:"{{ url('api/pengembalian') .'/'}}"+ id,
            columns: [
                {data: 'idbukutanah',name:'idbukutanah'},
                {data: 'no_hak',name:'no_hak'},
                {data: 'jenis_hak',name:'jenis_hak'},
                {data: 'desa',name:'desa'},
                {data: 'kecamatan',name:'kecamatan'},
                {data: 'no_warkah',name:'no_warkah'},
                {   
                    data: 'status_detail',
                    name:'status_detail',
                    "render": function ( data, type, row ){
                        if(data === '1'){
                            return '<span class="label label-success">Sudah Dikembalikan</span>';
                        }
                        else{
                            return '<span class="label label-warning">Belum Dikembalikan</span>';
                        }
                        
                    }
                },
                {data: 'action',name:'action',orderable:false, searchable:false}
            ],
                columnDefs: [ {
                searchable: false,
                orderable:false,
                targets: 0
            } ],  
            order: [[ 4, 'desc' ]],
            language: {
                lengthMenu: "Menampilkan _MENU_",
                zeroRecords: "Data tidak ada",
                info: "Halaman _PAGE_ dari _PAGES_ Halaman",
                infoEmpty: "-",
                infoFiltered: "(dari _MAX_ total data)",
                loadingRecords: "Silahkan Tunggu...",
                processing:     "Dalam Proses...",
                search:         "Cari:",
                paginate: {
                    first:      "Awal",
                    last:       "Akhir",
                    next:       "Selanjutnya",
                    previous:   "Kembali"
                },
            },
            
            aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "Semua"]],
            {{-- iDisplayLength: 15 --}}
        })
        
    });
    function updateStatusDetail(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('peminjamandetail/proses')}}/" + id,
            type: "POST",
            data: {'_method': 'DELETE','_token': csrf_token
            },
            success: function(data) {
                $('#data-detail').dataTable().api().ajax.reload();
                $('div.flash-message').html(data);
                    
            },
            error: function () {
                alert("Opppps gagal");
            }
        })
    }

    
</script>
@endpush
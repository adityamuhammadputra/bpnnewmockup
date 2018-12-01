<style>
    #results img{
        height: 300px;
        width: 420px;
        margin-top: 45px;
    }
</style>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#222222">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ambil gambar #<a id="no_berkasJudul"></a></h4>
            </div>
            <div class="modal-body" id="form-peminjamanprosesdetail">
                <form method="post" action="{{url('/kamera')}}">
                    @method('POST')
                    @csrf
                    <input type="hidden" id="idKamera" name="id_kamera">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="camera"></div>
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="col-md-6">
                            <div id="results">Gambar Hasil ....</div>
                        </div>
                        <div class="col-md-12 text-center">
                            <br/>
                            <button type="button" onClick="take_snapshot()" class="btn btn-primary"><i class="fa fa-camera"></i> Ambil Gambar</button>
                            <button class="btn btn-success" id="btn-kirim" style="visibility: hidden;"><i class="fa fa-check"></i> Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>

        Webcam.set({
			width:400,
			height:390,
			image_format: 'jpeg',
			jpeg_quality: 90
		});

		Webcam.attach('#camera');

		function take_snapshot(){
			Webcam.snap(function(data_uri){
				$(".image-tag").val(data_uri)
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                document.getElementById('btn-kirim').style.visibility = "visible"; 
			})
		}

        
    </script>

@endpush
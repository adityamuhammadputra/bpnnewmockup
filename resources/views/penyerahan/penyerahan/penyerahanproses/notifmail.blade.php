@component('mail::message')
# Hay {{ $data['nama1'] }}

Berkas anda dengan no_berkas #{{$data['no_berkas']}}, sudah dapat diambil. Silahkan untuk datang ke kantor BPN kabupaten Bogor. 


<img src="{{url('images/bpnlogo.png')}}" style="height: 100px; display: block; margin-left: auto; margin-right: auto; width: 100px;" data-auto-embed="attachment"/> 


Hormat Kami,<br>
Admin Penyerahan Dokumen - {{$data['admin']}}
@endcomponent
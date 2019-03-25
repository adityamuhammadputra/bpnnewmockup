@extends('layouts.master')

@section('content')
<style>
.timeline-badge > .fa{
    position: relative;
    top: 13px;
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-maps"></em>
            </a></li>
            <li class="active">Petas</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    NIB #{{ $data->nib }}
                </div>
                <div class="panel-body timeline-container">
                    <div class="col-md-4">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge primary"><i class="fa fa-code"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Wilayah</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Kode Wilayah: {{ $data->kodewilaya }}</p>
                                        <p>Kelurahan : {{ $data->kelurahan }}</p>
                                        <p>Kecamatan : {{ $data->kecamatan }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge"><i class="fa fa-clipboard"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Detail</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Tipe Hak : {{ $data->tipehak }}</p>
                                        <p>Tahun : {{ $data->tahun }}</p>
                                        <p>Luas Tertul : {{ $data->luastertul }}</p>
                                        <p>Luas Peta : {{ $data->luaspeta }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge warning"><i class="fa fa-user"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Pemegang Hak</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Nama : User Lengkap</p>
                                        <p>Tgl Lahir : - </p>
                                        <p>Alamat : - </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge success"><i class="fa fa-dollar"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Info Perpajakan</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>NOP : 12345567</p>
                                        <p>NJOP : -</p>
                                        <p>Nilai ZNT : -</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="timeline-panel">
                            <br>
                            <div class="timeline-body">
                                <p><img src="{{ asset('images/pakansari.png') }}" width="100%"></p>
                                <p><img src="{{ asset('images/qrcode.png') }}" width="20%" class="pull-left"></p>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@push('scripts')
   
@endpush

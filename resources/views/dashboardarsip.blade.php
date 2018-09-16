@extends('layouts.master')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-dashboard"></em>
            </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div><!--/.row-->
  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grafik Progress Peminjaman Dan Pengembalian Sistem Kearsipan
                    <ul class="pull-right panel-settings panel-button-tab-right">
                        <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                            <em class="fa fa-cogs"></em>
                        </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <ul class="dropdown-settings">
                                        <li><a href="#">
                                            <em class="fa fa-cog"></em> Settings 1
                                        </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">
                                            <em class="fa fa-cog"></em> Settings 2
                                        </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">
                                            <em class="fa fa-cog"></em> Settings 3
                                        </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        {{-- <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas> --}}
                        <canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md126">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Progress Jumlah Kegiatan Unit Kerja KANTAH KAB.BOGOR
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    {{-- <div class="col-md-12 no-padding">
                        @foreach($data2 as $kecamatan=>$jumlah)
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan {{ $kecamatan }}</div>
                            <div class="col-sm-6" style="text-align: right;">{{ $jumlah }} Data</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: {{ $jumlah }}%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="90"></div>
                        </div>
                        @endforeach --}}
                        <div class="row progress-labels">
                            <div class="col-sm-6">PENGECEKAN</div>
                            <div class="col-sm-6" style="text-align: right;">1500</div>
                        </div>
                        <div class="progress">
                                <div data-percentage="0%" style="width: 80%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row progress-labels">
                                <div class="col-sm-6">BALIK NAMA</div>
                                <div class="col-sm-6" style="text-align: right;">350</div>
                            </div>
                        <div class="progress">
                                <div data-percentage="0%" style="width: 10%;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row progress-labels">
                             <div class="col-sm-6">SKPT</div>
                             <div class="col-sm-6" style="text-align: right;">190</div>
                        </div>
                        <div class="progress">
                                <div data-percentage="0%" style="width: 30%;" class="progress-bar progress-bar-grey" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="row progress-labels">
                             <div class="col-sm-6">SERTIFIKAT RUSAK</div>
                             <div class="col-sm-6" style="text-align: right;">80</div>
                         </div>
                         <div class="progress">
                                <div data-percentage="0%" style="width: 5%;" class="progress-bar progress-bar-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                         <div class="row progress-labels">
                             <div class="col-sm-6">SERTIFIKAT HILANG</div>
                              <div class="col-sm-6" style="text-align: right;">10</div>
                         </div>
                         <div class="progress">
                                <div data-percentage="0%" style="width: 2%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">PERALIHAN HAK</div>
                            <div class="col-sm-6" style="text-align: right;">850</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 60%;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">SK</div>
                            <div class="col-sm-6" style="text-align: right;">350</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 40%;" class="progress-bar progress-bar-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">ROYA HAK TANGGUNGAN</div>
                            <div class="col-sm-6" style="text-align: right;">480</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="10%" style="width: 50%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
    </div><!--/.row-->
@push('scripts')
<script>

    window.onload = function () {
        var chart2 = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(chart2).Bar(
            {
                labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli", "Agustus","September","Oktober","November","Desember"],
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : [
                            @foreach($data as $d)
                               {{ 700-$d->pengecekan->count() }},
                               {{ 850-$d->pengecekan->count() }},

                               {{ 720-$d->pengecekan->count() }},

                            @endforeach
                        ]

                    },
                    {
                        fillColor : "rgba(48, 164, 255, 0.2)",
                        strokeColor : "rgba(48, 164, 255, 0.8)",
                        highlightFill : "rgba(48, 164, 255, 0.75)",
                        highlightStroke : "rgba(48, 164, 255, 1)",
                        data : [
                            @foreach($data as $d)
                               {{ 1000-$d->pengecekan->count() }},
                               {{ 875-$d->pengecekan->count() }},
                               {{ 705-$d->pengecekan->count() }},

                            @endforeach
                        ]
                    }
                ]
        
            }
        , {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc",
        scaleOverride: true,
        scaleSteps: 10,
        scaleStepWidth: 100, 
        });
    };
</script>
@endpush

@endsection


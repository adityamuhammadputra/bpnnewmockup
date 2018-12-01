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
                    Grafik Progress Input Per Kelompok
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Progress Kecamatan Wilayah Bogor Selatan
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 no-padding">
                        @foreach($data2 as $kecamatan=>$jumlah)
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan {{ $kecamatan }}</div>
                            <div class="col-sm-6" style="text-align: right;">{{ $jumlah }} Data</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: {{ $jumlah }}%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="90"></div>
                        </div>
                        @endforeach
                     
                        
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Cijeruk</div>
                            <div class="col-sm-6" style="text-align: right;">60%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 60%;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Cigombong</div>
                            <div class="col-sm-6" style="text-align: right;">40%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 40%;" class="progress-bar progress-bar-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Ciawi</div>
                            <div class="col-sm-6" style="text-align: right;">100%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="10%" style="width: 100%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Progress Kecamatan Wilayah Bogor Barat
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 no-padding">
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Ciseeng</div>
                            <div class="col-sm-6" style="text-align: right;">20%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 20%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="90"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Cileungsi</div>
                            <div class="col-sm-6" style="text-align: right;">40%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 40%;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Ciomas</div>
                            <div class="col-sm-6" style="text-align: right;">40%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: 40%;" class="progress-bar progress-bar-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row progress-labels">
                            <div class="col-sm-6">Kecamatan Ciampea</div>
                            <div class="col-sm-6" style="text-align: right;">50%</div>
                        </div>
                        <div class="progress">
                            <div data-percentage="10%" style="width: 50%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
     {{-- @foreach($data as $d)
                            {{ $d->pengecekan->count() }},
                        @endforeach --}}
@push('scripts')
<script>

    window.onload = function () {
        var chart2 = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(chart2).Bar(
            {
                labels : ["Kelompok 1","Kelompok 2","Kelompok 3","Kelompok 4","Kelompok 5","Kelompok 6","Kelompok 7", "Kelompok 8"],
                datasets : [
                    {
                        fillColor : "rgba(255,255,0,0.5)",
                        strokeColor : "rgba(255,255,0,0.8)",
                        highlightFill: "rgba(255,255,0,0.75)",
                        highlightStroke: "rgba(255,255,0,1)",
                        data : [
                            300, 600, 200, 400, 700,200,300,400
                        ]

                    },
                    {
                        fillColor : "rgba(48, 164, 255, 0.2)",
                        strokeColor : "rgba(48, 164, 255, 0.8)",
                        highlightFill : "rgba(48, 164, 255, 0.75)",
                        highlightStroke : "rgba(48, 164, 255, 1)",
                        data : [
                            700, 400, 800, 600, 300,800,700,600
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


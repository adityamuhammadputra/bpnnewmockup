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
    {{-- <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kelompok 1
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <div id="donut1" style="width:100%; height:355px;"></div>
                        <p>Target : balbalala</p>
                        <p>Misal  : balbalala</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kelompok 2
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <div id="donut2" style="width:100%; height:355px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kelompok 3
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <div id="donut3" style="width:100%; height:355px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kelompok 4
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <div id="donut4" style="width:100%; height:355px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row--> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Site Traffic Overview
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
@php
    $a = 700;
@endphp
@push('scripts')
<script>
    //chart donat
    {{-- function graphDonut(colors) {
        Morris.Donut({
            element: 'donut1',
            colors : colors,
            data   : [
                {label: "Penyerahan Berkas %", value: {{ '9' }}},
                {label: "Target Berkas %", value: {{ '91' }}}
            ]
        });
        Morris.Donut({
            element: 'donut2',
            colors : colors,
            data   : [
                {label: "Progres Input Data %", value: 10},
                {label: "Progres Input Data", value: 90}
            ]
        });
        Morris.Donut({
            element: 'donut3',
            colors : colors,
            data   : [
                {label: "Progres Input Data %", value: 10},
                {label: "Progres Input Data", value: 90}
            ]
        });
        Morris.Donut({
            element: 'donut4',
            colors : colors,
            data   : [
                {label: "Progres Input Data %", value: 10},
                {label: "Progres Input Data", value: 90}
            ]
        });
    }
    graphDonut( ['rgb(59,148,217)', 'rgb(26,187,156)'] ); --}}

    window.onload = function () {
        var chart2 = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(chart2).Bar(
            {
                labels : ["Kelompok 1","Kelompok 2","Kelompok 3","Kelompok 4","Kelompok 5","Kelompok 6","Kelompok 7", "Kelompok 8"],
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : [{{ $a }},200,100,200,300,400,500,600]
                    },
                    {
                        fillColor : "rgba(48, 164, 255, 0.2)",
                        strokeColor : "rgba(48, 164, 255, 0.8)",
                        highlightFill : "rgba(48, 164, 255, 0.75)",
                        highlightStroke : "rgba(48, 164, 255, 1)",
                        data : [100,200,100,200,300,400,500,600]
                    }
                ]
        
            }
        , {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
        });
    };
</script>
@endpush

@endsection


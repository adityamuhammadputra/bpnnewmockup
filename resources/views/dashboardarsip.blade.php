@extends('layouts.master')

@section('content')
<style>
.panel-heading {
  font-size: 14px !important;
}
</style>
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grafik Penyerahan SMS Senter
                    <ul class="pull-right panel-settings panel-button-tab-right">
                        <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                            <em class="fa fa-cogs"></em>
                        </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <ul class="dropdown-settings">
                                        <li><a href="#">
                                            <em class="fa fa-cog"></em> 2019
                                        </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">
                                            <em class="fa fa-cog"></em> 2020
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
                        <canvas id="myChart" width="50" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Response Masyarakat SMS Senter
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="storage/{{ $tab2->default_foto->foto }}" class="img img-responsive img-default-slider" width="100%">
                        </div>
                        <div class="col-md-6">
                            <h4 class="nama-default-slider">{{ $tab2->default_foto->nama1 }}</h4>
                            <table class="table">
                                <tr>
                                    <td>Penerima </td>
                                    <td>:</td>
                                    <td>{{ $tab2->default_foto->nama2 }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat </td>
                                    <td>:</td>
                                    <td>{{ $tab2->default_foto->alamat }}</td>
                                </tr>
                                 <tr>
                                    <td>No HP </td>
                                    <td>:</td>
                                    <td>{{ $tab2->default_foto->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="owl-carousel">
                        @foreach($tab2->slider_pernyerahan as $path => $nama1)
                            <div>
                                <a href="#" class="slider-click" data-path="{{ $path }}" data-nama1="{{ $nama1 }}"><img windth="150" height="150" src="storage/{{ $path }}"/></a>
                                <h5>{{ $nama1 }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grafik Per Jenis Kegiatan
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas id="myChart2" width="150" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

@push('scripts')
<script>

$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
        items:4,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1300,
        autoplayHoverPause:true
  });
});

$('.slider-click').on('click', function () {
    var path = 'storage/' + $(this).data('path');
    var nama1 = $(this).data('nama1');

    $('.img-default-slider').attr('src', path);
    $('.nama-default-slider').html(nama1);
})
var ctx = document.getElementById('myChart');
var ctx2 = document.getElementById('myChart2');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            // label: '# 2019',
            data: [12, 19, 15, 9, 12, 11, 12, 19, 15, 9, 12, 11],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false,
                    // stepSize: 

                }
            }]
        }
    }
});

var myChar2 = new Chart(ctx2, {
    type: 'horizontalBar',
    data: {
        labels: [{!! $tab3->label !!}],
        datasets: [{
            // label: '# 2019',
            data: [{{ $tab3->data }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false,
                    // stepSize: 

                }
            }]
        }
    }
});
</script>
@endpush

@endsection


@extends('layouts.master')

@section('content')
 
<link href="{{asset('lumino/css/leaflet.css')}}" rel="stylesheet">
<style>
    #mapid {
        height: 750px;
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
            <div class="panel panel-default">
                <div id="mapid"></div>
            </div>
        </div>
    </div>
@push('scripts')
  
    <script src="{{ asset('lumino/js/leaflet.js') }}"></script>
    <script src="{{ asset('lumino/js/leaflet.ajax.js') }}"></script>
    <script>
        var mymap = L.map('mapid').setView([-6.4949415, 106.8312041], 15);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiYWRpdHlhbXVoYW1tYWRwdXRyYSIsImEiOiJjanRrZW8xa3EzOXBtNDVvMzk5cnozNW83In0.mlYblsZ-tCAKkDb3L3nHJA'
            }).addTo(mymap);
        
        var mystyle = {
            "color" : "#808080",
            "weight" : 2,
            "opacity" : 0.40
        }

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                // for (key in f.properties) {
                //     out.push(key + ": " + f.properties[key]);
                // }
                out.push("NIB :" + f.properties.NIB);
                out.push("KECAMATAN :"+ f.properties.KECAMATAN);
                out.push("KELURAHAN :" + f.properties.KELURAHAN);
                out.push("TIPEHAK :"+ f.properties.TIPEHAK);
                out.push("LUASTERTUL :" + f.properties.LUASTERTUL);
                out.push("<br/>");
                out.push("<a class='btn btn-sm btn-primary' href='peta/" + f.properties.ID + "'>Detail</a>");
                l.bindPopup(out.join("<br />"));
            }
        }

        var json = "{{ asset('lumino/json.json') }}";
        
        var jsonTest = new L.GeoJSON.AJAX([json], { onEachFeature: popUp, style: mystyle }).addTo(mymap);

    </script>
@endpush

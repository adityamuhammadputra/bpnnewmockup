@extends('layouts.master')

@section('content')
 
<link href="{{asset('lumino/css/leaflet.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
<link href="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.css" rel="stylesheet">

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
    {{--  --}}
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF_8YmHJFCWlyLx1m4lkKZq5WFQ-q5BsA" async defer></script>
    {{-- <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
  integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
  crossorigin=""></script> --}}

    <script src='https://unpkg.com/leaflet.gridlayer.googlemutant@latest/Leaflet.GoogleMutant.js'></script>
    <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script>
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
            "opacity" : 0.90
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

        var satMutant  = L.gridLayer.googleMutant({
            type: 'satellite'// valid values are 'roadmap', 'satellite', 'terrain' and 'hybrid'
        }).addTo(mymap);

        var terrainMutant = L.gridLayer.googleMutant({
			maxZoom: 24,
			type:'terrain'
		});

        L.control.layers({
			Satelite: satMutant,
			Terrain: terrainMutant,
		}, {}, {
			collapsed: true
		}).addTo(mymap);

        var searchLayer = L.geoJson().addTo(mymap);
        // L.mymap('map', { searchControl: {layer: searchLayer} });
        // var searchLayer = L.layerGroup().addTo(mymap);
        // L.map('mymap', { searchControl: {layer: searchLayer} });
        mymap.addControl( new L.Control.Search({layer: searchLayer}) );

    </script>
@endpush

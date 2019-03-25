<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BPN Kab Bogor') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link href="{{asset('lumino/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('lumino/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('lumino/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('lumino/css/datepicker3.css')}}" rel="stylesheet">
	<link href="{{ asset('lumino/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/jquery.dataTables.yadcf.0.9.2.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/sweetalert2.min.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/googlefont.css')}}" rel="stylesheet">
    <link href="{{asset('lumino/css/styles.css')}}" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('images/bpnlogo.png') }}">

	

</head>
<style>
.time-custom{
	float: left;
    position: relative;
    left: -20px;
	top: 20px;
	font-size: 16px
}
#date{
	margin-right: 10px;
	color: white;
}
#time{
	color: white;

}
.userpanel{
	position: relative;
    width: 100%;
    padding: 10px;
    overflow: hidden;
}
.userpanel>.infos {
    padding: 5px 5px 5px 30px;
    line-height: 1;
    position: absolute;
    left: 55px;
	font-size: 19px;
}
.userpanel>.infos a {
	cursor: pointer;
}
</style>
<script>
window.onload = setInterval(clock,1000);

    function clock()
    {
	  var d = new Date();
	  
	  var date = d.getDate();
	  
	  var month = d.getMonth();
	  var montharr =["Jan","Feb","Mar","April","May","June","July","Aug","Sep","Oct","Nov","Dec"];
	  month=montharr[month];
	  
	  var year = d.getFullYear();
	  
	  var day = d.getDay();
	  var dayarr =["Sun","Mon","Tues","Wed","Thurs","Fri","Sat"];
	  day=dayarr[day];
	  
	  var hour =d.getHours();
      var min = d.getMinutes();
	  var sec = d.getSeconds();
	
	  document.getElementById("date").innerHTML=day+" "+date+" "+month+" "+year;
	  document.getElementById("time").innerHTML=hour+":"+min+":"+sec;
    }
</script>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{ asset('images/Logos.png') }}" target="_blank"><img src="{{ asset('images/Logos.png') }}" class="imglogoss"></a><c class="hidden-xs"><span class="namabpn"><a> BPN</a>Kab.bogor</span></c>
				<ul class="nav navbar-top-links navbar-right visible-lg visible-md visible-sm">
					<a class="time-custom">
					<em class="fa fa-calendar-check-o" style="color:white"></em> <span id="date"></span>
					<em class="fa fa-clock-o" style="color:white"></em> <span id="time"></span>
					</a>
					<li class="dropdown">
						{{-- <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"> --}}
						{{-- <em class="fa fa-bell"></em><span class="label label-info">5</span> --}}
						<img src="{{ asset(auth()->user()->photo) }}" data-toggle="dropdown" class="img-circle" alt="User Image" width="40px" height="40px">

					{{-- </a> --}}
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="{{ url('editprofile',Auth::user()->id) }}">
								<div><em class="fa fa-user"></em> {{ Auth::user()->name }}
								</div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-key"></em> {{ Auth::user()->jabatan_profile }}
								</div>
							</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								<div><em class="fa fa-power-off"></em> Logout
								</div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="visible-xs userpanel">
			<div class="pull-left">
				<img src="{{ asset(auth()->user()->photo) }}" data-toggle="dropdown" class="img-circle" alt="User Image" width="60px" height="60px">
			</div>
			<div class="pull-left infos">
				<a href="{{ url('editprofile',Auth::user()->id) }}" title="Ubah data user">
					{{ Auth::user()->name }}
				</a>
				<p style="font-size: 13px;margin-top: 15px;"><em class="fa fa-key"></em> {{ Auth::user()->jabatan_profile }}</p>
			</div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<div class="clear"></div>
		@php  $user = request()->user() @endphp
		<ul class="nav menu">
			@if ($user->hasAnyRole(['admin','sysadmin',]) || $user->hasAnyPermission(['dashboardptsl.read']))
			<li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('home') }}"><em class="fa fa-map">&nbsp;</em> Lapindek</a></li>
			@endif
			@if ($user->hasAnyRole(['admin','sysadmin',]) || $user->hasAnyPermission(['dashboardarsip.read']))
			<li class="{{ request()->is('dashboardarsip') ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard Kearsipan</a></li>
			@endif
			@if ($user->hasAnyRole(['admin','sysadmin','warkah']))
				<li class="{{ request()->is('datawarkah') ? 'active' : '' }}"><a href="{{ url('datawarkah') }}"><em class="fa fa-sticky-note">&nbsp;</em> Penataan Warkah</a></li>
			@endif
			@if ($user->hasAnyRole(['admin','sysadmin','bukutanah']))
			<li class="parent {{ request()->is('peminjaman/master') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-4">
				<em class="fa fa-navicon">&nbsp;</em>BukuTanah <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li><a class="" href="{{ url('peminjaman/master') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Buku Tanah Penataan
					</a></li>
					<li><a class="" href="{{ url('peminjamanmasterwalboard') }}" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Buku Tanah Wallboard
					</a></li>
					<li><a class="" href="{{ url('peminjaman/history') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Buku Tanah History
					</a></li>
				</ul>
			</li>
			@endif	
			@if ($user->hasAnyRole(['admin','sysadmin','ptsl']))
			<li class="parent {{ request()->is('ptsl/pengecekan') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Program PTSL <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="{{ route('dataptsl.index') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> PTSL Data Master
					</a></li>
					<li><a class="" href="{{ url('pengecekan') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> PTSL Pengecekan 
					</a></li>
				</ul>
			</li>
			@endif	
			@if ($user->hasAnyRole(['admin','sysadmin','peminjamanproses','peminjamankegiatan']))
			<li class="parent {{ request()->is('peminjaman/proses') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-dropbox">&nbsp;</em> Peminjaman <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					@if ($user->hasAnyPermission(['peminjamanproses.read']))
					<li><a class="" href="{{ url('peminjaman/proses') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Proses
					</a></li>
					@endif
					@if ($user->hasAnyPermission(['peminjamankegiatan.read']))
					<li><a class="" href="{{ url('peminjaman/kegiatan') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Kegiatan
					</a></li>
					@endif
					<li><a class="" href="{{ url('peminjaman/tunggakan') }}" >
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Tunggakan
					</a></li>
					<li><a class="" href="{{ url('peminjaman/kontrol') }}" >
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Kontrol
					</a></li>
				</ul>
			</li>
			@endif
			@if ($user->hasAnyRole(['admin','sysadmin','pengembalian']))
			<li class="parent {{ request()->is('pengembalian') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-reply-all">&nbsp;</em> Pengembalian <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="{{ url('pengembalian') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Pengembalian Proses 
					</a></li>
					<li><a class="" href="{{ url('pengembalianwallboard') }}" target="_blank">
						<span class="fa fa-arrow-right">&nbsp;</span> Pengembalian Wallboard
					</a></li>
					<li><a class="" href="{{ url('pengembalianhistory') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Pengembalian History
					</a></li>
				</ul>
			</li>
			@endif
			@if ($user->hasAnyPermission(['penyerahanproses.read','penyerahanloket.read']))
			@if ($user->hasAnyPermission(['penyerahanproses.read']))
			<li class="{{ request()->is('penyerahan') ? 'active' : '' }}"><a href="{{ url('penyerahan') }}"><em class="fa fa-book">&nbsp;</em> Penyerahan Proses</a></li>
			@endif
			@if ($user->hasAnyPermission(['penyerahanloket.read']))
			<li class="{{ request()->is('penyerahanloket') ? 'active' : '' }}"><a href="{{ url('penyerahanloket') }}"><em class="fa fa-laptop">&nbsp;</em> Penyerahan Loket</a></li>
			@endif
			<li class="{{ request()->is('penyerahanhistory') ? 'active' : '' }}"><a href="{{ url('penyerahanhistory') }}"><em class="fa fa-calendar-times-o">&nbsp;</em> Penyerahan History</a></li>

			
			{{-- <li class="parent {{ request()->is('penyerahan') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-5">
				<em class="fa fa fa-book">&nbsp;</em> Penyerahan Sertifikat <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-5">
					@if (Auth::user()->penyerahan_menu == 1|| Auth::user()->id == 2)
					<li><a class="" href="{{ url('penyerahan') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Penyerahan Proses 
					</a></li>
					@endif

					@if (Auth::user()->penyerahan_menu == 2 || Auth::user()->id == 2)
					<li><a class="" href="{{ url('penyerahanloket') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Penyerahan Loket
					</a></li>
					@endif

					<li><a class="" href="{{ url('penyerahanhistory') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Penyerahan History
					</a></li>
				</ul>
			</li> --}}
			@endif


				
			{{-- <li style="padding-top:10px; border-top: 1px solid #e9ecf2;"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li> --}}
			@if ($user->hasAnyRole(['admin','sysadmin']))
			<li class="parent {{ request()->is('user') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-sub-item-user">
				<em class="fa fa-users">&nbsp;</em> Users <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-sub-item-user">
					<li><a class="" href="{{ url('user') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Users List 
					</a></li>
					<li><a class="" href="{{ url('userrole') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Users Roles
					</a></li>
					<li><a class="" href="{{ url('userpermission') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Users Permission
					</a></li>
				</ul>
			</li>
			{{-- <li class="{{ request()->is('user') ? 'active' : '' }}"><a href="{{ url('user') }}"><em class="fa fa-users">&nbsp;</em> User</a></li> --}}
			@endif
			{{-- <li class="{{ request()->is('peta') ? 'active' : '' }}"><a href="{{ url('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard PTSL</a></li> --}}

			<li class="visible-xs"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="fa fa-lock"></em> Logout</a></li>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</ul>
	</div><!--/.sidebar-->
	{{-- <div class="flash-message"></div> --}}
	
	@yield('content')
		
	<div class="row">
        <div class="col-sm-12">
            <p class="back-link"><a href="http://kab-bogor.atrbpn.go.id/">&copy; 2018 BPN Kab.Bogor</a> Template by Lumino <a href="https://www.medialoot.com">Medialoot</a></p>
        </div>
	</div>

	<div class="row" style="bottom: 0px;left: 0;position: fixed;z-index: 11111;">
		<div class="col-sm-12">
			@include('layouts.alerts') 
			<div class="flash-message"></div> 
		</div>
	</div>

</div>
	
	
  
  <script src="{{asset('lumino/js/jquery.min.js')}}"></script>
  <script src="{{asset('lumino/js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('lumino/js/jquery-1.12.4.min.js')}}"></script>
  {{-- <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}

  <script src="{{asset('lumino/js/jquery-ui.js')}}"></script>
  <script src="{{asset('lumino/js/chosen.jquery.min.js')}}"></script>

  <script src="{{asset('lumino/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('lumino/js/moment.min.js')}}"></script>
  <script src="{{asset('lumino/js/localid.js')}}"></script>
  <script src="{{asset('lumino/js/bootstrap-datetimepicker.min.js')}}"></script>
  
  <script src="{{asset('lumino/js/sweetalert2.min.js')}}"></script>

  <script src="{{asset('lumino/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('lumino/js/dataTables.bootstrap.js')}}"></script>
  <script src="{{asset('lumino/js/jquery.dataTables.yadcf.0.9.2.js')}}"></script>


  <script src="{{asset('lumino/js/validator.min.js') }}"></script>

  <script src="{{asset('lumino/js/chart.min.js')}}"></script>
  <script src="{{asset('lumino/js/chart-data.js')}}"></script>
  <script src="{{asset('lumino/js/easypiechart.js')}}"></script>
  <script src="{{asset('lumino/js/easypiechart-data.js')}}"></script>

  <script src="{{asset('lumino/js/morris.min.js')}}"></script>
  <script src="{{asset('lumino/js/raphael.min.js')}}"></script>

  <script src="{{asset('lumino/js/custom.js')}}"></script>
  <script>
		
  </script>
  @stack('scripts')
  </body>
</html>
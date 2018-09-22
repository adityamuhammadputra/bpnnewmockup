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
    
    <link rel="shortcut icon" href="{{ asset('images/Logos.png') }}">

	

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a href="{{ asset('images/Logos.png') }}" target="_blank"><img src="{{ asset('images/Logos.png') }}" class="imglogoss"></a><c class="hidden-xs"><span class="namabpn"><a> BPN</a>Kab.bogor</span></c>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<a href="{{ asset(auth()->user()->photo) }}" target="_blank"><img src="{{ asset(auth()->user()->photo) }}" class="img-responsive" alt="User Image"></a>
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>10 Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard PTSL</a></li>
			<li class="{{ request()->is('dashboardarsip') ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard Kearsipan</a></li>
			<li class="{{ request()->is('datawarkah') ? 'active' : '' }}"><a href="{{ url('datawarkah') }}"><em class="fa fa-sticky-note">&nbsp;</em> Warkah Kab. Bogor</a></li>
			<li class="parent {{ request()->is('ptsl/pengecekan') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Program PTSL <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="{{ route('dataptsl.index') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Data PTSL
					</a></li>
					<li><a class="" href="{{ url('pengecekan') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Pengecekan PTSL
					</a></li>
				</ul>
			</li>
			<li class="parent {{ request()->is('peminjaman/master') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-dropbox">&nbsp;</em> Peminjaman <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="{{ url('peminjaman/master') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Master
					</a></li>
					<li><a class="" href="{{ url('peminjaman/proses') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Proses
					</a></li>
					<li><a class="" href="{{ url('peminjaman/kegiatan') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Kegiatan
					</a></li>
					<li><a class="" href="{{ url('peminjaman') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Peminjaman Kontrol
					</a></li>
				</ul>
			</li>
			<li class="parent {{ request()->is('pengembalian') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-reply-all">&nbsp;</em> Pengembalian <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="{{ url('pengembalian') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Proses Pengembalian 
					</a></li>
					<li><a class="" href="{{ url('pengembalianhistory') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> History Pengembalian
					</a></li>
				</ul>
			</li>
			{{-- <li class="{{ request()->is('pengembalian') ? 'active' : '' }}"><a href="{{ url('pengembalian') }}"><em class="fa fa-reply-all">&nbsp;</em> Pengembalian</a></li> --}}
				
			<li style="padding-top:10px; border-top: 1px solid #e9ecf2;"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
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
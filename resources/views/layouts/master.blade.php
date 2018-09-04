<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BPN Kab Bogor') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link href="{{asset('lumino/css/bootstrap.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="{{asset('lumino/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('lumino/css/datepicker3.css')}}" rel="stylesheet">
	<link href="{{ asset('lumino/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/jquery.dataTables.yadcf.0.9.2.css') }}" rel="stylesheet">
	<link href="{{asset('lumino/css/sweetalert2.min.css') }}" rel="stylesheet">

    <link href="{{asset('lumino/css/styles.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>BPN</span>Bogor</a>
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
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
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
			<li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
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
			<li class="parent {{ request()->is('bukutanah') ? 'active' : '' }} "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-dropbox">&nbsp;</em> Peminjaman <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="{{ url('bukutanah') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Buku Tanah
					</a></li>
					<li><a class="" href="{{ url('peminjaman') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Peminjaman
					</a></li>
					<li><a class="" href="{{ url('peminjamanloket') }}">
							<span class="fa fa-arrow-right">&nbsp;</span> Loket Peminjaman
						</a></li>
					<li><a class="" href="{{ url('peminjamanmonitoring') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Monitoring Peminjaman
					</a></li>
					<li><a class="" href="{{ url('peminjamanproses') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Proses Peminjaman
					</a></li>
				</ul>
			</li>

			<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
	@yield('content')
	

	
	<div class="row">
        <div class="col-sm-12">
            <p class="back-link"><a href="http://kab-bogor.atrbpn.go.id/">&copy; 2018 BPN Kab.Bogor</a> Template by Lumino <a href="https://www.medialoot.com">Medialoot</a></p>
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

  <script src="{{asset('lumino/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('lumino/js/custom.js')}}"></script>
  <script>
		
  </script>
  @stack('scripts')
  </body>
</html>
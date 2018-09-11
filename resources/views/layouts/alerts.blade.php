@if(session('success'))
<div class="alert alert-success alert-dismissible fixed" role="alert">
	<i class="icon fa fa-check-square-o"></i>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	{{session('success')}}
</div>
@endif

@if(session('info'))
<div class="alert alert-info alert-dismissible fixed" role="alert">
	<i class="icon fa fa-info-circle"></i>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	{{session('info')}}
</div>
@endif

@if(session('danger'))
<div class="alert alert-danger alert-dismissible" role="alert">
		<i class="icon fa fa-times-circle"></i>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	{{session('danger')}}
</div>
@endif

<script>	
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>

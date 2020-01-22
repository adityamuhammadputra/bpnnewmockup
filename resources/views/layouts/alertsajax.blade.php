@if( Session::has("success") )
<div class="alert alert-success alert-block" role="alert">
    <i class="icon fa fa-check-square-o"></i>
    
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("success") }}
</div>
@endif

@if( Session::has("info") )
<div class="alert alert-info alert-block" role="alert">
    <i class="icon fa-info-circle"></i>
    
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("info") }}
</div>
@endif

@if( Session::has("error") )
<div class="alert alert-danger alert-block" role="alert">
    <i class="icon fa fa fa-times-circle"></i>
    
    <button class="close" data-dismiss="alert"></button>
    {{ Session::get("error") }}
</div>
@endif

<script>	
	window.setTimeout(function() {
    $(".alert").fadeTo(2000, 0).slideUp(2000, function(){
        $(this).remove(); 
    });
}, 10000);

</script>
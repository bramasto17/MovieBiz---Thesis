@extends('Layout/master')
@section('Title')
My Profile
@endsection

@section('Content')
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{isset($history) ? $history->backdrop_path : ''}}) no-repeat scroll center top / cover;">
	<div class="container">
		<div class="row"><div class ="profile-name">{{$user->name}}</div></div>
		<div class="row"><div class="profile-image"><img src="../images/team-4.jpg"></div></div>
		<h2>TEST</h2>
		@if($user->id != Auth::user()->id)
			<div class="row"><button id="follow">Follow</button></div>
			<a href="/AAAAAAAAAAAAAAAA">test</a>
		@endif
		<script src="http://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery.noConflict();
			jQuery(document).ready(function(){
				jQuery("#follow").click(function(){
					console.log("clicked");
					jQuery.get("test",function(data){
						alert(data);
					});				
				});
			});
		</script>
	
	</div>
</header>

<section class="padding-info">
	<h1>Followers</h1>
	<h1>Following</h1>
</section>

@endsection
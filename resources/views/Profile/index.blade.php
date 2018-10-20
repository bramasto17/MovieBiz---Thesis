@extends('Layout/master')
@section('Title')
Feed
@endsection

@section('Content')
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{isset($history) ? $history->backdrop_path : ''}}) no-repeat scroll center top / cover;">
	<div class="container">
		<div class="row profile-name">{{Auth::user()->name}}</div>
		<div class="row"><div class="profile-image"><img src="images/team-4.jpg"></div></div>
		<h2>TEST</h2>
	</div>
</header>

@endsection
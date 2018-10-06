@extends('Layout/master')

@section('Content')

<div id="home" >
<div class="container">
<div class="row animate-in" data-anim-type="fade-in-up">
<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
	<form action="/register" method="POST">
		{{csrf_field()}}
		<h3>Username</h3>
		<input type="text" name="txtUsername" placeholder="username">
		<h3>Email</h3>
		<input type="text" name="txtEmail" placeholder="email">
		<h3>Password</h3>
		<input type="password" name="txtPassword" placeholder="Password">
		<br><br>
		<input type="submit" value="Register" class=" btn button-custom btn-custom-two"></input>
	</form>
</div>

</div>
</div>
</div>

@endsection
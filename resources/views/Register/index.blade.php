@extends('Layout/master')
@section('Title')
Register
@endsection
@section('Content')

<!-- Home-Area -->
    <header class="home-area overlay" id="Login_SignUp" id="home_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="space-30 hidden-xs"></div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.4s">Join us now.</h3>
                    <div class="space-20"></div>
                    <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                        <div class="Login_SignUp-form text-center">
                            <form action="/register" method="POST">
								{{csrf_field()}}
								<div class="field-form">
                                    <input type="text" class="control" placeholder="Username" required="required" name="txtUsername" id="txtUsername" >
                                </div>
                                <div class="field-form">
                                    <input type="email" class="control" placeholder="Email" required="required" name="txtEmail" id="txtEmail" >
                                </div>
                                <div class="field-form">
                                    <input type="password" class="control" placeholder="Password" required="required" name="txtPassword" id="txtPassword">
                                </div>
                                <input class="bttn-white wow fadeInUp" type="submit" value="Register"></input>
                            </form>
                        </div>

                    </div>
                    <div class="space-20"></div>
                    <h5 class="wow fadeInUp" data-wow-delay="0.4s">Already a member? <a href="/login"><u>Login!</u></a></h5>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>
    </header>
    <!-- Home-Area-End -->

{{--<div id="home" >--}}
{{--<div class="container">--}}
{{--<div class="row animate-in" data-anim-type="fade-in-up">--}}
{{--<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">--}}
	{{--<form action="/register" method="POST">--}}
		{{--{{csrf_field()}}--}}
		{{--<h3>Username</h3>--}}
		{{--<input type="text" name="txtUsername" placeholder="username">--}}
		{{--<h3>Email</h3>--}}
		{{--<input type="text" name="txtEmail" placeholder="email">--}}
		{{--<h3>Password</h3>--}}
		{{--<input type="password" name="txtPassword" placeholder="Password">--}}
		{{--<br><br>--}}
		{{--<input type="submit" value="Register" class=" btn button-custom btn-custom-two"></input>--}}
	{{--</form>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

@endsection
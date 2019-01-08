@extends('Layout/master')
@section('Title')
Login
@endsection
@section('Content')
	<!-- Home-Area -->
    <header class="home-area overlay" id="Login_SignUp" style="background: url(https://image.tmdb.org/t/p/original{{$popular[rand(0,19)]->backdrop_path}}) no-repeat scroll center bottom / cover;" id="home_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="space-20 hidden-xs"></div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.4s">Already have an account?<br>Login here.</h3>
                    <div class="space-20"></div>
                    <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                        <div class="Login_SignUp-form text-center">
                            <form action="/login" method="POST" id="login_form">
								{{csrf_field()}}
                                <div class="field-form">
                                    <input type="email" class="control" placeholder="Email" required="required" name="txtEmail" id="txtEmail" >
                                </div>
                                <div class="field-form">
                                    <input type="password" class="control" placeholder="Password" required="required" name="txtPassword" id="txtPassword">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <input id="login_submit" class="bttn-white wow fadeInUp" type="submit" value="Login"></input>
                            </form>
                        </div>

                    </div>
                    @if(isset($message))
                    <h3>{{$message}}</h3>
                    @endif
                    <div class="space-20"></div>
                    <h5 class="wow fadeInUp" data-wow-delay="0.4s">Not a User? <a href="/register"><u>Sign Up!</u></a></h5>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>
    </header>
    <!-- Home-Area-End -->
@endsection
@push('scripts')
<script type="text/javascript">
    $("#login_form").submit(function () {
        $('.preloader').fadeIn(3500);
    });
</script>
@endpush
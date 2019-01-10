@extends('Layout/master')
@section('Title')
    Change Password
@endsection
@section('Content')
    <section class="gallery-area section-padding list" id="gallery_page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="space-20 hidden-xs"></div>
                    <h3 class="wow fadeInUp" data-wow-delay="0.4s" align="center">Change Password</h3>
                    <div class="space-20"></div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                        <div class="Login_SignUp-form text-center">
                            <form action="/changepassword" method="POST">
                                {{csrf_field()}}
                                <div class="field-form">
                                    <input type="password" class="control" placeholder="Current Password" required="required" name="txtCurrPass">
                                </div>
                                <div class="field-form">
                                    <input type="password" class="control" placeholder="New Password" required="required" name="txtNewPass">
                                </div>
                                <div class="field-form">
                                    <input type="password" class="control" placeholder="Confirm Password" required="required" name="txtConfirmPass">
                                </div>
                                <input class="bttn-white wow fadeInUp" type="submit" value="Submit"></input>
                            </form>
                        </div>
                    </div>

                    <div class="space-100"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
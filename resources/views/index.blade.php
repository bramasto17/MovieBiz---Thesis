@extends('Layout/master')
@section('Title')
MovieBiz
@endsection
@section('Content')
    <!-- Home-Area -->
    <header class="home-area overlay" style="background: url(https://image.tmdb.org/t/p/original{{$popular[rand(0,19)]->backdrop_path}}) no-repeat scroll center bottom / cover;" id="home_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="space-30 hidden-xs"></div>
                    <h1 class="wow fadeInUp" data-wow-delay="0.4s">Start your amazing watching experience.</h1>
                    <div class="space-20"></div>
                    <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                        <p>Share to your friends what you're watching.<br>Track your watching activity.<br>Discuss the movie.<br>Let the world know what you think of the movie.</p>
                    </div>
                    <div class="space-20"></div>
                    <a href="#about_page" class="bttn-white wow fadeInUp" data-wow-delay="0.8s" id="more">Get to Know More</a>
                    <div class="space-80"></div>
                </div>
            </div>
        </div>
    </header>
    <!-- Home-Area-End -->
    <!-- About-Area -->
    <section class="section-padding" id="about_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="page-title text-center">
                        <img src="images/about-logo.png" alt="About Logo">
                        <div class="space-20"></div>
                        <h5 class="title">About Appy</h5>
                        <div class="space-30"></div>
                        <h3 class="red-color">A beautiful app for consectetur adipisicing elit, sed do eiusmod tempor incididunt ut mollit anim id est laborum. Sedut perspiciatis unde omnis. </h3>
                        <div class="space-20"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About-Area-End -->
    <!-- Feature-Area -->
    <section class="feature-area section-padding-top overlay" style="background: url(https://image.tmdb.org/t/p/original{{$popular[1]->backdrop_path}}) no-repeat scroll center bottom / cover;" id="features_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="page-title text-center">
                        <h5 class="title">Features</h5>
                        <div class="space-10"></div>
                        <h3>Many things you can do here</h3>
                        <div class="space-60"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box-icon">
                            <i class="lnr lnr-film-play"></i>
                        </div>
                        <h4>Check-In &amp; Update your feed</h4>
                        <p>Check-In what you're watching right now so that your friends know.</p>
                    </div>
                    <div class="space-60"></div>
                    <div class="service-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="box-icon">
                            <i class="lnr lnr-user"></i>
                        </div>
                        <h4>Check Your Friends' Activities</h4>
                        <p>You can find out what your friends are currently watching on your feed.</p>
                    </div>
                    <div class="space-60"></div>
                    <div class="service-box wow fadeInUp" data-wow-delay="0.6s">
                        <div class="box-icon">
                            <i class="lnr lnr-history"></i>
                        </div>
                        <h4>Track Your Watching Activity</h4>
                        <p>Track what you're watching and be amazed with how long you spend your time watching everyday.</p>
                    </div>
                    <div class="space-60"></div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <figure class="wow fadeInUp mobile-image">
                        <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$popular[1]->poster_path}}">
                    </figure>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box-icon">
                            <i class="lnr lnr-magnifier"></i>
                        </div>
                        <h4>Find Information</h4>
                        <p>You can easily find about every information about the movie here.</p>
                    </div>
                    <div class="space-60"></div>
                    <div class="service-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="box-icon">
                            <i class="lnr lnr-star-half"></i>
                        </div>
                        <h4>Rate &amp; Review</h4>
                        <p>Share your opinion about the movie to your friends and the world.</p>
                    </div>
                    <div class="space-60"></div>
                    <div class="service-box wow fadeInUp" data-wow-delay="0.6s">
                        <div class="box-icon">
                            <i class="lnr lnr-bubble"></i>
                        </div>
                        <h4>Disscussion</h4>
                        <p>Discuss about the movie with others. Confused about what happened in the movie? You can also find explanation of it.</p>
                    </div>
                    <div class="space-60"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature-Area-End -->
@endsection
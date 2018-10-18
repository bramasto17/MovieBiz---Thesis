@extends('Layout/master')
@section('Title')
    {{$movie->title}} [{{$movie->release_date->year}}] Forum
@endsection
@section('Content')
    <section class="overlay no-scroll" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat center center fixed;" id="reviews-section">
        {{--<div class="space-80"></div>--}}
        <div class="section-padding">
            <div class="container" >
                <div class="row">
                    <div class="col-xs-1">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <a href="#"><i class="fa fa-angle-up fa-3x"></i></a><br>
                                <h3 style="margin-left: 5px;">0</h3>
                                <a href="#"><i class="fa fa-angle-down fa-3x"></i></a><br>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-2">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <img alt="" src="{{ URL::to('/') }}/images/person.png">
                                    <div align="center">User</div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-9">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <div class="post-tags badge-red">Spoiler Thread</div>
                                    <div class="post-date">01.02.2017</div>
                                </div>
                                <h4 class="dark-color"><a href="single.html">5 tips for those, who need to make more room in their closet</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                                <a href="single.html" class="read-more">View Article</a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <a href="#"><i class="fa fa-angle-up fa-3x"></i></a><br>
                                <h3 style="margin-left: 5px; margin-top: 3px">0</h3>
                                <a href="#"><i class="fa fa-angle-down fa-3x"></i></a><br>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-2">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <img alt="" src="{{ URL::to('/') }}/images/person.png">
                                    <div align="center">User</div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-9">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <div class="post-tags badge-green">Non Spoiler Thread</div>
                                    <div class="post-date">01.02.2017</div>
                                </div>
                                <h4 class="dark-color"><a href="single.html">5 tips for those, who need to make more room in their closet</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                                <a href="single.html" class="read-more">View Article</a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <a href="#"><i class="fa fa-angle-up fa-3x"></i></a><br>
                                <h3 style="margin-left: 5px; margin-top: 3px">0</h3>
                                <a href="#"><i class="fa fa-angle-down fa-3x"></i></a><br>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-2">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <img alt="" src="{{ URL::to('/') }}/images/person.png">
                                    <div align="center">User</div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-xs-9">
                        <article class="post-single sticky">
                            <div class="post-body">
                                <div class="post-meta">
                                    <div class="post-tags badge-blue">Fan Theory</div>
                                    <div class="post-date">01.02.2017</div>
                                </div>
                                <h4 class="dark-color"><a href="single.html">5 tips for those, who need to make more room in their closet</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                                <a href="single.html" class="read-more">View Article</a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
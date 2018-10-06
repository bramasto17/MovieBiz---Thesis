@extends('Layout/master')
@section('Title')
My Activity
@endsection
@section('Content')
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{$history->backdrop_path}}) no-repeat scroll center top / cover;">
    <div class="container">
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Last movie watched</h4>
            <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{$history->title}}</h1>
        </div>
    </div>
</header>
<section class="section-padding info" id="price_page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h4 class="title">Your activity this month</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div id="chart"></div>
        </div>
    </div>
</section>
<script type="text/javascript" src="/js/barchart.js"></script>
@endsection
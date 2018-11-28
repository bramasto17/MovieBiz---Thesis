@extends('Layout/master')
@section('Title')
My Activity
@endsection
@section('Content')
@if(!isset($history))
<header class="home-area activity overlay">
    <div class="container">
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">You haven't watched anything</h4>
            <h4 class="wow fadeInUp" data-wow-delay="0.4s"><a href="/discover">Start watching now</a></h4>
        </div>
    </div>
</header>
@else
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{$history->movie()->backdrop_path}}) no-repeat scroll center top / cover;">
    <div class="container">
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Last movie watched</h4>
            <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{$history->movie()->title}}</h1>
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">{{$history->created_at}}</h4>
        </div>
    </div>
</header>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center wow fadeInUp">
                    <h3 class="title">Stats</h3>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp stats">
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user->total}}</span>
                        </div>
                        <h4>times watched</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user->movies}}</span>
                        </div>
                        <h4>movies watched</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user->average}}</span>
                        </div>
                        <h4>average rating</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user->reviews}}</span>
                        </div>
                        <h4>reviews given</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12" id="div_history">
                <div class="page-title text-center">
                    <h4 class="title">Your activity for the past 30 days</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="wow fadeInUp" id="chart_month"></div>
        </div>
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h4 class="title">Your Most Watched Movies</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        @if(isset($mosts[0]))
        <div class="row">
            <div class="col-xs-6">
                <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
                    <img id="backdrop" src="https://image.tmdb.org/t/p/original{{$mosts[0]->movie()->backdrop_path}}" alt="">
                </figure>
            </div>
            <div class="col-xs-6">
                <table class="table allcp-form theme-warning tc-checkbox-1 fs13 wow fadeInUp">
                    <tbody>
                        @foreach($mosts as $data)
                        <tr class="most_watched" id="{{$data->movie()->backdrop_path}}">
                            <td><a href="/movie/{{$data->movieId}}">{{$data->movie()->title}}</a></td>
                            <td>{{$data->total}} times</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row">
            <center>
                <h4 class="wow fadeInUp" data-wow-delay="0.4s">You haven't watched anything</h4>
            </center>
        </div>
        @endif
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="col-xs-6" id="div_genre">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title text-center">
                        <h4 class="title">Your favourite genres</h4>
                        <!-- <div class="space-60"></div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
                    <div class="wow fadeInUp" id="chart_genre"></div>
                </center>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title text-center">
                        <h4 class="title">Your best movies</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($rating_top as $data)
                    <div class="col-xs-6 col-sm-4 poster-list">
                        <div class="item wow fadeInUp" id="top_rated">
                            <a href="/movie/{{$data->movieId}}">
                                <img src="@if(@file_get_contents('https://image.tmdb.org/t/p/w185_and_h278_bestv2'.$data->movie()->poster_path) === false) {{ URL::to('/') }}/images/poster.jpg @else https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->movie()->poster_path}} @endif" alt="">
                                <div class="overlay">
                                    <div class="text">
                                        {{$data->movie()->title}}<br>
                                        <span class="review-rating"> {{$data->rating}}
                                            <span class="icon">★</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<script type="text/javascript" src="/js/watch-history.js"></script>
<script type="text/javascript" src="/js/favourite-genres.js"></script>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#my-activity").addClass("active");
    });
    $('.most_watched').mouseover(function() {
        // alert( this.id );
        document.getElementById("backdrop").src="https://image.tmdb.org/t/p/original"+this.id;
    });
</script>
@endpush
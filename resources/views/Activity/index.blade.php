@extends('Layout/master')
@section('Title')
My Activity
@endsection
@section('Content')
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{count($history) != 0 ? $history[0]->movie()->backdrop_path : ''}}) no-repeat scroll center top / cover;">
    <div class="container">
        @if(isset($history))
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Last movie watched</h4>
            <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{$history[0]->movie()->title}}</h1>
        </div>
        @else
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">You haven't watched anything</h4>
        </div>
        @endif
    </div>
</header>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h3 class="title">Stats</h3>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row stats">
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
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h4 class="title">Your activity this month</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div id="chart_month"></div>
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
                            <td>{{$data->movie()->title}}</td>
                            <td>{{$data->total}} times</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h4 class="title">Your favourite genres</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div id="chart_genre"></div>
        </div>
    </div>
</section>
<script type="text/javascript" src="/js/watch-history.js"></script>
<!-- <script type="text/javascript" src="/js/favourite-genres.js"></script> -->
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
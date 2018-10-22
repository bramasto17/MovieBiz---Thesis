@extends('Layout/master')
@section('Title')
My Activity
@endsection
@section('Content')
<header class="home-area activity overlay" style="background: url(https://image.tmdb.org/t/p/original{{isset($history) ? $history->backdrop_path : ''}}) no-repeat scroll center top / cover;">
    <div class="container">
        @if(isset($history))
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Last movie watched</h4>
            <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{$history->title}}</h1>
        </div>
        @else
        <div class="row">
            <h4 class="wow fadeInUp" data-wow-delay="0.4s">You haven't watched anything</h4>
        </div>
        @endif
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
            <div id="chart_month"></div>
        </div>
    </div>
</section>
<section class="section-padding info" id="price_page">
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
                    <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$movie->poster_path}}" alt="">
                </figure>
            </div>
            <div class="col-xs-6">
                <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                    <tbody>
                        @foreach($leaves as $leave)
                        <tr>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="/js/watch-history.js"></script>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#my-activity").addClass("active");
    });
</script>
@endpush
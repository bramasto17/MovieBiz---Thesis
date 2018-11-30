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
@include('Activity/activity')
@endif
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
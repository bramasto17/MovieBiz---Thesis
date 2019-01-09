@extends('Layout/master')
@section('Title')
Home
@endsection
@section('Content')
<section class="gallery-area section-padding list" id="gallery_page">
    <div class="container-fluid">
        <div class="row">
<!--             <div class="col-xs-12" align="center">
                <form action="/login" method="GET">
                    <div class="field-form">
                        <input type="text" class="control" placeholder="I want to watch...." required="required" name="txtSearch" id="txtSearch">
                    </div>
                    <input id="login_submit" class="bttn-white wow fadeInUp" type="submit" value="Login"></input>
                </form>
            </div> -->
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="text-center">
                    <h3 class="blue-color">Start watching something</h3>
                    <div class="search-home">
                        <form action="/search" id="search-home" autocomplete="off">
                            <input type="text" class="control" placeholder="I want to watch..." required="required" id="txtSearch" name="txtSearch">
                            <button class="bttn-white active" type="submit"><i class="fa fa-search fa-lg"></i> Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="space-80"></div>
            <div class="col-xs-12 col-sm-12 gallery-slider">
                <div class="page-title text-center">
                    <h4 class="title">Popular Movies</h4>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 gallery-slider">
                <div class="gallery-slide">
                    @foreach($popular as $data)
                    <div class="item">
                        <a href="/movie/{{$data->id}}">
                            <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->poster_path}}" alt="{{$data->title}}">
                            <div class="overlay">
                                <div class="text">{{$data->title}}</div>
                              </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="space-20"></div>
            <div class="col-xs-12 col-sm-12" align="center">
                <a href="/discover">
                    <h4>
                        <button class="bttn-default bttn-top-padding">
                            Discover more movies
                        </button>
                    </h4>
                </a>
            </div>
        </div>
        <div class="space-40"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 gallery-slider">
                <div class="col-xs-12 col-sm-12 gallery-slider">
                    <div class="page-title text-center">
                        <h4 class="title">Your Feed</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 gallery-slider">
                    @if(count($feeds)==0)
                    <div class="row">
                        <center>
                            <div class="space-40"></div>
                            <h3>No activities</h3>
                        </center>
                    </div>
                    @else
                    @foreach($feeds as $feed)
                    <div class="row box" >
                        <div class="col-xs-12 col-md-1">
                            <figure class="comment-pic">
                                <img alt="" src="{{ URL::to('/').$feed->user->profile_pict }}">
                            </figure>
                        </div>
                        <div class="col-xs-12 col-md-11">
                            <div>
                                <h4><a href="" class="">{{$feed->user->name}}</a></h4>
                                <h4>{{$feed->text}}</h4>
                                <h5>Posted on: {{$feed->created_at}}</h5>
                                <div class="space-20"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12" align="center">
                    <a href="/feed">
                        <h4>
                            <button class="bttn-default bttn-top-padding">
                                View more feed
                            </button>
                        </h4>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 gallery-slider">
                <div class="col-xs-12 col-sm-12 gallery-slider">
                    <div class="page-title text-center">
                        <h4 class="title">Your Timeline</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 gallery-slider">
                    @if(count($timelines)==0)
                    <div class="row">
                        <center>
                            <div class="space-40"></div>
                            <h3>No activities</h3>
                        </center>
                    </div>
                    @else
                    @foreach($timelines as $timeline)
                    <div class="row box" >
                        <div class="col-xs-12 col-md-1">
                            <figure class="comment-pic">
                                <img alt="" src="{{ URL::to('/').$timeline->user->profile_pict }}">
                            </figure>
                        </div>
                        <div class="col-xs-12 col-md-11">
                            <div>
                                <h4><a href="" class="">{{$timeline->user->name}}</a></h4>
                                <h4>{{$timeline->text}}</h4>
                                <h5>Posted on: {{$timeline->created_at}}</h5>
                                <div class="space-20"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12" align="center">
                    <a href="/profile/{{\Auth::user()->id}}/timeline">
                        <h4>
                            <button class="bttn-default bttn-top-padding">
                                View more timeline
                            </button>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#home").addClass("active");
    });
</script>
@endpush
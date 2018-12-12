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
    </div>
</section>
\\
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#home").addClass("active");
    });
</script>
@endpush
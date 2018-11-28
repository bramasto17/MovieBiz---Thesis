@extends('Layout/master')
@section('Title')
Search Results for "{{$search}}"
@endsection
@section('Content')
<section class="gallery-area section-padding list" id="search_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <center>
                    <h4>Search Results for "{{$search}}"</h4>
                    <h3>
                        <span id="movies_search" class="active">Movies</span>
                        <span id="users_search">Users</span>
                    </h3>
                </center>
            </div>
        </div>
        <div class="row" id="movies_result">
            @if(count($movies)==0)
            <center>
                <h3>Nothing Found</h3>
            </center>
            @else
           	@foreach($movies as $data)
            <div class="col-xs-6 col-sm-2 poster-list">
                <div class="item">
                    <a href="/movie/{{$data->getID()}}">
                        <!-- <img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->getPoster()}}" alt=""> -->
                        <img src="@if(@file_get_contents('https://image.tmdb.org/t/p/w185_and_h278_bestv2'.$data->getPoster()) === false) {{ URL::to('/') }}/images/poster.jpg @else https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->getPoster()}} @endif" alt="">
                        <div class="overlay">
                            <div class="text">{{$data->getTitle()}}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="row hide" id="users_result">
            <div class="col-xs-12 col-sm-4">
                @if(count($users)==0)
                <center>
                    <h3>Nothing Found</h3>
                </center>
                @else
                @foreach($users as $user)
                <div class="row box" >
                        <div class="col-xs-12 col-md-4">
                            <figure class="comment-pic">
                                <img alt="" src="{{ URL::to('/') }}{{$user->profile_pict}}">
                            </figure>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div>
                                <h3><a href="/profile/{{$user->id}}">{{$user->name}}</a></h3>
                                <h4>@if($user->id == \Auth::user()->id)  @elseif($user->isFollowing()) Following @else Not Following @endif</h4>
                                <div class="space-20"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#movies_search").click(function(){
            $("#movies_search").addClass("active");
            $("#movies_result").removeClass("hide");
            $("#users_search").removeClass("active");
            $("#users_result").addClass("hide");
        });

        $("#users_search").click(function(){
            $("#users_search").addClass("active");
            $("#users_result").removeClass("hide");
            $("#movies_search").removeClass("active");
            $("#movies_result").addClass("hide");
        });
    });
</script>
@endpush
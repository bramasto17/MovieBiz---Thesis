@extends('Layout/master')
@section('Title')
Home
@endsection
@section('Content')
<section class="gallery-area section-padding list" id="gallery_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h1>Search Results for "{{$search}}"</h1>
                <h2>Movies</h2>
            </div>
        </div>
        <div class="row">
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
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <h2>User</h2>
                @if(count($users)==0)
                    <h3>Nothing Found</h3>
                @else
                @foreach($users as $user)
                <a href="/profile/{{$user->id}}">{{$user->name}}</a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
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
            </div>
        </div>
        <div class="row">
           	@foreach($movies as $data)
            <div class="col-xs-6 col-sm-2 poster-list">
                <a href="/movie/{{$data->getID()}}"><img src="https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->getPoster()}}" alt=""></a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
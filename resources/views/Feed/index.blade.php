@extends('Layout/master')
@section('Title')
Feed
@endsection

@section('Content')

<section class="overlay no-scroll" style="background: url('https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}') no-repeat center center fixed;" id="reviews-section">
        <div class="space-80"></div>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-1"></div>
                <div class="col-xs-12 col-md-10">
                    {{--START POST--}}
                        @if(isset($timelines))
                        @foreach($timelines as $timeline)
                        <div class="row" id="timeline">
                            <div class="col-xs-12 col-md-1">
                                <figure class="comment-pic">
                                    <img alt="" src="{{ URL::to('/') }}/images/person.png">
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
                        @else
                        @endif
                    {{--END POST--}}
                </div>
            </div>
        </div>
    </section>
@endsection
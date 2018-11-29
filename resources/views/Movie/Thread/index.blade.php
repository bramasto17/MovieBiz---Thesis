@extends('Layout.master')
@section('Title')
    {{$movie->title}} [{{$movie->release_date->year}}] Forum
@endsection
@section('Content')
    <section class="overlay no-scroll" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat center center fixed;" id="reviews-section">
        <div class="space-80"></div>

        <div class="container">
            <h4><a href="/movie/{{$movie->id}}"><span class="lnr lnr-arrow-left-circle"></span> Back to info</a></h4>
            <div class="col-xs-12 col-md-3">
                <figure class="wow fadeInUp" data-wow-delay="0.2s">
                    <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$movie->poster_path}}" alt="">
                    <div class="space-30"></div>
                    <h3 align="center">{{$movie->title}}</h3>
                    <h4 align="center">({{count($threads)}} Threads)</h4>
                </figure>
            </div>

            {{-- Header --}}
            <div class="col-xs-10 col-md-7 thread-header" align="center">
                Thread Topic
            </div>

            <div class="col-xs-1 col-md-1 thread-header">
                Creator
            </div>

            <div class="col-xs-1 col-md-1 thread-header">
                Posts
            </div>

            {{-- Content --}}
            @if(count($threads) > 0)
                @foreach($threads as $thread)
                    <div class="col-xs-10 col-md-7 thread-content limit-word">
                        <a href="thread/{{$thread->id}}">{{isset($thread->title) ? $thread->title : ''}}</a>
                    </div>

                    <div class="col-xs-1 col-md-1 thread-content">
                        {{isset($thread->name) ? $thread->name : ''}}
                    </div>

                    <div class="col-xs-1 col-md-1 thread-content">
                        {{isset($thread->posts) ? $thread->posts : ''}} posts
                    </div>
                @endforeach

            @else
                <div class="col-xs-12 col-md-9 thread-content" align="center">
                    No thread at the moment
                </div>
            @endif

            {{-- Create new thread--}}
            <div class="col-xs-12 col-md-9" align="right" style="margin-top: 50px">
                <button id="myBtn" class="bttn-default bttn-half-padding">
                    Create New Thread
                </button>
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>

                    <form id="modalForm" action="/createThread" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="movieId" value="{{$movie->id}}">
                        <input type="hidden" name="forumId" value="{{$forum->id}}">
                        <input type="hidden" name="creatorId" value="{{Auth::user()->id}}">
                        <input type="text" name="title" class="form-control" placeholder="Write title for this thread"></input>
                        <div class="space-30"></div>

                        <div align="right">
                            <button type="submit" class="bttn-default bttn-half-padding">Post</button>
                        </div>
                    </form>
                </div>

            </div>





        </div>

    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endpush

@extends('Layout/master')
@section('Title')
    {{$movie->title}} [{{$movie->release_date->year}}] Forum
@endsection
@section('Content')
    <section class="overlay no-scroll" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat center center fixed;" id="reviews-section">
        <div class="space-80"></div>

        <div class="container">
            <h4><a href="/movie/{{$movie->id}}/forum"><span class="lnr lnr-arrow-left-circle"></span> Back to info</a></h4>

            <div class="row">
                <div class="col-xs-12 col-md-1"></div>

                <div class="col-xs-12 col-md-10">

                    <div class="border-round-white">
                        <h4><a href="profile/{{$thisThread->userId}}" class="">{{$thisThread->userName}}</a> <small>Posted on: {{$thisThread->created_at}}</small></h4>
                        <h4>{{$thisThread->title}}</h4>
                    </div>

                    {{--START MODAL CRT POST--}}
                    <div align="right" style="margin-top: 25px; margin-bottom: 25px">
                        <button id="myBtn" class="bttn-default bttn-half-padding">
                            Create New Post
                        </button>
                        @if($creator == true || \Auth::user()->admin())
                        <a href="deleteThread/{{$thisThread->id}}">
                            <button id="myBtn" class="bttn-default bttn-half-padding bttn-admin">
                                Delete Thread
                            </button>
                        </a>
                        @endif
                    </div>

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <form id="modalForm" action="/createPost" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="threadId" value="{{$thisThread->id}}">
                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                <textarea name="txtContent"  rows="3" class="form-control" placeholder="Write post here"></textarea>
                                <div class="space-30"></div>
                                <div align="right">
                                    <button type="submit" class="bttn-default bttn-half-padding">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{--END MODAL CRT POST--}}

                    {{--START POST--}}
                    @if($posts)
                        @foreach($posts as $post)
                            <div class="row" style="margin-top: 20px">
                                <div class="col-xs-12 col-md-1"></div>
                                <div class="col-xs-12 col-md-11">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <h4><a href="/profile/{{$post->userId}}" class="">{{$post->userName}}</a> <small>Posted on: {{$post->created_at}}</small></h4>
                                        </div>
                                        <div class="col-md-1">
                                            @if(\Auth::user()->admin())
                                            <a href="/deletePost/{{$post->id}}">
                                                <button id="myBtn" class="bttn-default bttn-half-padding bttn-admin">
                                                    <i class="fa fa-trash fa-lg"></i>
                                                </button>
                                            </a>
                                            @endif   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4>{{$post->content}}</h4>
                                        <button id="myBtnSub">
                                            <small><span class="fa fa-reply"></span> Reply</small>
                                        </button>
                                    </div>


                                    <div id="myModalSub" class="modal">
                                        <div class="modal-content">
                                            <span class="close">&times;</span>

                                            <form id="modalForm" action="/createPost" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" name="threadId" value="{{$thisThread->id}}">
                                                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="subpost" value="{{$post->id}}">

                                                <textarea name="txtContent"  rows="3" class="form-control" placeholder="Write subpost here"></textarea>
                                                <div class="space-30"></div>

                                                <div align="right">
                                                    <button type="submit" class="bttn-default bttn-half-padding">Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    {{--START SUBPOST--}}
                                    @foreach($subposts as $subpost)
                                        @if($subpost->subpost == $post->id)

                                            <div class="row">
                                                <div class="col-xs-12 col-md-1"></div>
                                                <div class="col-xs-12 col-md-11">
                                                    <div>
                                                        <div class="col-xs-12 col-md-11">
                                                            <h4><a href="/profile/{{$subpost->userId}}" class="">{{$subpost->userName}}</a> <small>Posted on: {{$subpost->created_at}}</small></h4>
                                                            <h4>{{$subpost->content}}</h4>
                                                        </div>
                                                        <div class="col-md-1">
                                                            @if(\Auth::user()->admin())
                                                            <a href="/deletePost/{{$subpost->id}}">
                                                                <button id="myBtn" class="bttn-default bttn-half-padding bttn-admin">
                                                                    <i class="fa fa-trash fa-lg"></i>
                                                                </button>
                                                            </a>
                                                            @endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{--END POST--}}

                </div>
            </div>
        </div>
        
        <div class="space-80"></div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Get the modal
        var modal = document.getElementById('myModal');
        var modalsub = document.getElementById('myModalSub');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        var btnsub = document.getElementById("myBtnSub");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }
        btnsub.onclick = function() {
            modalsub.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
            modalsub.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modalsub) {
                modalsub.style.display = "none";
            }
        }
    </script>
@endpush

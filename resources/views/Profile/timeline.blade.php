@extends('Profile/index')
@section('data')
<div class="container" id="profile_page">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title text-center">
                <h5 class="title">Timelines</h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-1"></div>
        <div class="col-xs-12 col-md-10">
            {{--START POST--}}
                @if(count($timelines)==0)
                <div class="row">
                    <center>
                        <div class="space-40"></div>
                        <h3>No timelines</h3>
                    </center>
                </div>
                @else
                @foreach($timelines as $timeline)
                <div class="row box" >
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
                <div class="space-80"></div>
                @endif
            {{--END POST--}}
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#timeline").addClass("active");
    });
</script>
@endpush
@endsection

@extends('Profile/index')
@section('data')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title text-center">
                <h5 class="title">Followers</h5>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($followers as $follower)
        <div class="col-xs-12 col-sm-3">
            <div class="footer-box">
                <div class="profile-image-m">
                    <img src="{{$follower->follower->profile_pict}}">
                </div>
                <p><a href="">{{$follower->follower->name}}</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
            </div>
            <div class="space-30 hidden visible-xs"></div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#followers").addClass("active");
    });
</script>
@endpush
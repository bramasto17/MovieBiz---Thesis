@extends('Profile/index')
@section('data')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title text-center">
                <h5 class="title">Following</h5>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($followings as $following)
        <div class="col-xs-12 col-sm-3">
            <div class="footer-box">
                <div class="profile-image-m">
                    <img src="{{$following->following->profile_pict}}">
                </div>
                <p><a href="">{{$following->following->name}}</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
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
        $("#following").addClass("active");
    });
</script>
@endpush
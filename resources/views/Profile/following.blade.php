@extends('Layout/master')
@section('Title')
    My Profile
@endsection

@section('Content')
    <section class="gallery-area section-padding list">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-2">
                </div>
                <div class="col-xs-12 col-sm-2 profile-image">
                    <img src="../images/person.png">
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="col-sm-4"><h3>{{$user->name}}</h3></div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        @if($isOwnAccount)
                            <button id="editProfileBtn" class="bttn-white bttn-half-padding">Edit Profile</button>
                        @else
                            <button class="bttn-white bttn-half-padding">Follow</button>
                            {{--<button class="bttn-white bttn-half-padding">Report</button>--}}
                        @endif
                    </div>
                    <br><br>
                    <div align="center" id="profile-stat">
                        <div class="col-sm-2">
                            <a href="profile/{{$user->id}}"><b>8</b> Activities</a>
                        </div>
                        <div class="col-sm-2 active">
                            <a href="profile/{{$user->id}}/following"><b>88</b> Following</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="profile/{{$user->id}}/followers"><b>888</b> Followers</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="profile/{{$user->id}}/reviews"><b>111</b> Reviews</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="profile/{{$user->id}}/discussion"><b>11</b> Discussion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('Profile/editModal')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">Following</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <div class="footer-box">
                    <div class="profile-image-m">
                        <img src="../images/person.png">
                    </div>
                    <p><a href="">People 1</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="footer-box">
                    <div class="profile-image-m">
                        <img src="../images/person.png">
                    </div>
                    <p><a href="">People 2</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="footer-box">
                    <div class="profile-image-m">
                        <img src="../images/person.png">
                    </div>
                    <p><a href="">People 3</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="footer-box">
                    <div class="profile-image-m">
                        <img src="../images/person.png">
                    </div>
                    <p><a href="">People 4</a><br /> <button class="bttn-default bttn-half-padding">Un/Follow</button> </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('Profile/Script/follow')
    @include('Profile/Script/edit')
@endpush
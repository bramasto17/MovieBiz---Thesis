@extends('Layout/master')
@section('Title')
	@if($isOwnAccount)My Profile
	@else {{$user->name}}'s Profile
	@endif
@endsection

@section('Content')
	<section class="gallery-area section-padding list" id="profile_header">
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
							<button id="follow" class="bttn-white bttn-half-padding not-following">Follow</button>
							{{--<button class="bttn-white bttn-half-padding">Report</button>--}}
						@endif
					</div>
					<br><br>
					<div align="center" id="profile-stat">
						<div class="col-sm-2 active">
							<a href="profile/{{$user->id}}"><b>8</b> Activities</a>
						</div>
						<div class="col-sm-2">
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
                    <h5 class="title">Activities</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-1"></div>
            <div class="col-xs-12 col-md-10">
                {{--START POST--}}
                    @if(count($activities)==0)
                    <div class="row">
                        <center>
                            <div class="space-40"></div>
                            <h3>No activities</h3>
                        </center>
                    </div>
                    @else
                    @foreach($activities as $activity)
                    <div class="row box" >
                        <div class="col-xs-12 col-md-1">
                            <figure class="comment-pic">
                                <img alt="" src="{{ URL::to('/') }}/images/person.png">
                            </figure>
                        </div>
                        <div class="col-xs-12 col-md-11">
                            <div>
                                <h4><a href="" class="">{{$activity->user->name}}</a></h4>
                                <h4>{{$activity->text}}</h4>
                                <h5>Posted on: {{$activity->created_at}}</h5>
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

@endsection

@push('scripts')
	@include('Profile/Script/follow')
	@include('Profile/Script/edit')
@endpush

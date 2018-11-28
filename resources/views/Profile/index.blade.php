@extends('Layout/master')
@section('Title')
	@if($isOwnAccount)My Profile
	@else {{$user->name}}'s Profile
	@endif
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
							<button class="btn btn-primary">Edit Profile</button>
						@else
							<button class="btn btn-primary">Follow</button>
							{{--<button class="btn btn-primary">Report</button>--}}
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

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h5 class="title">Activities</h5>
                </div>
            </div>
        </div>

        <div class="row">
            Activities
        </div>
    </div>

@endsection
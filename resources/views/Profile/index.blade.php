@extends('Layout/master')
@section('Title')
	@if($isOwnAccount)My Profile
	@else {{$user->name}}'s Profile
	@endif
@endsection

@section('Content')
	<section class="home-area activity section-padding list overlay" @isset($history) style="background: url(https://image.tmdb.org/t/p/original{{isset($history) ? $history->movie()->backdrop_path:'' }}) no-repeat scroll center top / cover;" @else @endif id="profile_header">
		<div class="container-fluid" align="center">

			<div style="width: 60%;">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-2">
				</div>
				<div class="col-xs-12 col-sm-2 profile-image">
					<img src="{{$user->profile_pict}}">
				</div>

				<div class="col-xs-12 col-sm-6">
					<div class="col-sm-4" id="user_name"><a href="profile/{{$user->id}}/"><h3>{{$user->name}}</h3></a></div>
					<div class="col-sm-4">
						@if(\Auth::user()->admin() && $user->id != \Auth::user()->id)
						<a href="banUser/{{$user->id}}">
						<button id="ban" class="bttn-default bttn-half-padding bttn-admin">@if($user->active()) Ban User @else Unban User @endif</button>
						</a>
						@endif
					</div>
					<div class="col-sm-4">
						@if($isOwnAccount)
							<button id="editProfileBtn" class="bttn-white bttn-half-padding">Edit Profile</button>
						@else
							<button id="follow" class="bttn-white bttn-half-padding">Follow</button>
							<!-- {{--<button class="bttn-white bttn-half-padding">Report</button>--}} -->
						@endif
					</div>
					<br><br>
	                <div class="space-20"></div>
					<div align="center">
						<div class="col-sm-2" id="timeline">
							<a href="profile/{{$user->id}}/timeline"><b>{{$profile_header->timeline}}</b> <br> Timeline</a>
						</div>
						<div class="col-sm-2" id="following">
							<a href="profile/{{$user->id}}/following"><b>{{$profile_header->following}}</b> <br> Following</a>
						</div>
						<div class="col-sm-2" id="followers">
							<a href="profile/{{$user->id}}/followers"><b>{{$profile_header->followers}}</b> <br> Followers</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@isset($history)
		<center>
			<h5>Last Watching</h5>
			<h4>{{$history->movie()->title}}</h4>
			<h5>{{$history->created_at}}</h5>
		</center>
		@else
		@endif
	</section>
	@yield('data')
	@include('Profile/editModal')
@endsection

@push('scripts')
	@include('Profile/Script/follow')
	@include('Profile/Script/edit')
@endpush

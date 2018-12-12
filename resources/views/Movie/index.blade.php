@extends('Layout/master')
@section('Title')
{{$movie->title}} [{{$movie->release_date->year}}]
@endsection
@section('Content')
	<!-- Header-Area -->
	<header class="home-area overlay" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat scroll center bottom / cover;">
	    <div class="container">
            <input type="hidden" value="{!!csrf_token() !!}" id="token">
			<input type="hidden" name="movieId" value="{{$movie->id}}" id="movieId">
	        <div class="row">
	            <div class="col-xs-12 hidden-sm col-md-3">
	                <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
	                    <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$movie->poster_path}}" alt="">
	                </figure>
	            </div>
	            <div class="col-xs-12 col-md-9">
	                <h1 class="wow fadeInUp" data-wow-delay="0.4s">{{$movie->title}}</h1>
	                <div class="space-20"></div>
	                <div class="desc wow fadeInUp" data-wow-delay="0.6s">
	                    <p>{{$movie->overview}}</p>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Release : </span>
	                        <span>{{$movie->release_date->format('d M Y')}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Language : </span>
	                        <span>{{$movie->original_language}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Directors : </span>
	                        <span>{{$movie->casts['crew'][0]['name']}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Duration : </span>
	                        <span>{{$movie->runtime}} minutes</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Writers : </span>
	                        <span>{{isset($movie->casts['crew'][6]['name'])?$movie->casts['crew'][6]['name']:''}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Genre : </span>
	                        @foreach($movie->genres as $genre)
	                        <span>
	                        	{{$genre['name']}}, 
	                        </span>
	                        @endforeach
	                    </div>
	                </div>
	                <div class="space-20"></div>
	                @if($movie->status != "Released")
	                <div class="row text-center">
	                	<h5 class="wow fadeInUp">The movie is not released yet so you can't check in to the movie</h5>
	                </div>
	                @else
	                <div class="row movie-menu">
		                <div class="col-xs-12 col-sm-4">
                    		<div class="space-20"></div>
		                    	<button id="checkInMovie" class="bttn-white wow fadeInUp" data-wow-delay="0.8s"><i class="lnr lnr-film-play"></i>{{$stats->times_played > 0 ? 'Watch Again' : 'Chek-In Movie'}}<span class="lds-dual-ring" id="loadingDiv"></span></button>
		                </div>
		                <div class="col-xs-12 col-sm-8 wow fadeInUp" id="rating_section">
		                	<div class="row">
		                    	<span class="red-color">Your Rating: </span>
		                	</div>
		                	<div class="row">
		                		<div class="rating">
								  <label>
								    <input type="radio" name="stars" value="1" @if(isset($rating))@if($rating->rating == '1')checked @endif @endif />
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="2" @if(isset($rating))@if($rating->rating == '2')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="3" @if(isset($rating))@if($rating->rating == '3')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>   
								  </label>
								  <label>
								    <input type="radio" name="stars" value="4" @if(isset($rating))@if($rating->rating == '4')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="5" @if(isset($rating))@if($rating->rating == '5')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="6" @if(isset($rating))@if($rating->rating == '6')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="7" @if(isset($rating))@if($rating->rating == '7')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="8" @if(isset($rating))@if($rating->rating == '8')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="9" @if(isset($rating))@if($rating->rating == '9')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								  <label>
								    <input type="radio" name="stars" value="10" @if(isset($rating))@if($rating->rating == '10')checked @endif @endif />
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								    <span class="icon">★</span>
								  </label>
								</div>
								<span class="lnr lnr-checkmark-circle" id="message"></span>
		                	</div>
		                </div>
	                </div>
	                @endif
	            </div>
	        </div>
	    </div>
	</header>
	<!-- Home-Area-End -->
	<!--Stats-Area -->
	<section class="section-padding info">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="page-title text-center">
	                    <h3 class="title">Stats</h3>
	                    <!-- <div class="space-60"></div> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>{{$stats->users_played}}</span>
	                        </div>
	                        <h4>Users watched</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>{{$stats->total_review}}</span>
	                        </div>
	                        <h4>Reviews given</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>{{isset($stats->avg_rating) ? $stats->avg_rating : 'No data'}}</span>
	                        </div>
	                        <h4>Cinegram rating</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>{{$movie->vote_average}}</span>
	                        </div>
	                        <h4>TMDB rating</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- Stats-Area-End -->
	<!--Trailer-Area -->
	<section class="testimonial-area">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="page-title text-center">
	                    <h3 class="title">Trailer</h3>
	                    <!-- <div class="space-60"></div> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <center>
	            	<iframe src="https://www.youtube.com/embed/{{$movie->trailers['youtube'][0]['source']}}?ecver=2"frameborder="0"
						width="520px" height="292px" allowfullscreen></iframe>
	            </center>
	        </div>
	    </div>
	</section>
	<!-- Trailer-Area-End -->
	<!--Actors-Area -->
	<section class="testimonial-area">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="page-title text-center">
	                    <h3 class="title">Actors</h3>
	                    <div class="space-60"></div>
	                </div>
	            </div>
	        </div>
	        <div class="row team-box-container">
                @foreach($movie->casts['cast'] as $key=>$cast)
	                @if($key <= 5)
			            <div class="col-xs-4 team-box">
			        		<div class="col-xs-4">
			                    <img src="https://image.tmdb.org/t/p/w138_and_h175_face{{$cast['profile_path']}}" alt="" onerror="this.onerror=null;this.src='{{ URL::to('/') }}/images/actor.png';">
			                </div>
			        		<div class="col-xs-8">            			
			                    <h4>{{$cast['name']}}</h4>
			                    <span>{{$cast['character']}}</span>
			        		</div>
			            </div>
                	@else
                		<div class="col-xs-4 team-box more hidden">
			        		<div class="col-xs-4">
			                    <img src="https://image.tmdb.org/t/p/w138_and_h175_face{{$cast['profile_path']}}" alt="" onerror="this.onerror=null;this.src='{{ URL::to('/') }}/images/actor.png';">
			                </div>
			        		<div class="col-xs-8">            			
			                    <h4>{{$cast['name']}}</h4>
			                    <span>{{$cast['character']}}</span>
			        		</div>
			            </div>
			        @endif
                @endforeach
	        </div>
	        <div class="row">
				<div class="page-title text-center show-more">
					<h4 id="show-more-text">Show More</h4>
				</div>
	        </div>
	    </div>
	</section>
	<!-- Trailer-Area-End -->
	<!--Similar-Area -->
	@if(isset($similar))
	<section class="testimonial-area">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="page-title text-center">
	                    <h3 class="title">You May Also Like</h3>
	                    <!-- <div class="space-60"></div> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	        	@foreach($similar as $data)
                <div class="col-xs-6 col-sm-2 poster-list">
                    <div class="item wow fadeInUp" id="top_rated">
                        <a href="/movie/{{$data->id}}">
                            <img src="@if(@file_get_contents('https://image.tmdb.org/t/p/w185_and_h278_bestv2'.$data->poster_path) === false) {{ URL::to('/') }}/images/poster.jpg @else https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->poster_path}} @endif" alt="">
                            <div class="overlay">
                                <div class="text">
                                    {{$data->title}}<br>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
	        </div>
	    </div>
	</section>
	@endif
	<!-- Similar-Area-End-->
	<!-- Forum-Review-Area-->
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12 col-md-6">
	            <section class="section-padding price-area" id="forum">
	                <div class="row">
	                    <div class="col-xs-12">
	                        <div class="page-title text-center">
	                            <h3 class="title">Forum</h3>
	                        </div>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-xs-12 col-sm-12">
	                        <div class="price-box">
	                            <div class="price-body">
	                                <ul>
	                                	@if(isset($threads))
	                                	@foreach($threads as $thread)
	                                    <li><a href="thread/{{$thread->id}}">{{$thread->title}}</a></li>
	                                    @endforeach
	                                    @else
	                                    <li>No thread at the moment</li>
	                                    @endif
	                                </ul>
	                            </div>
	                            <div class="price-footer">
	                                <a href="/movie/{{$movie->id}}/forum" class="bttn-white">Go to movie's forum</a>
	                            </div>
	                        </div>
	                        <div class="space-30 hidden visible-xs"></div>
	                    </div>
	                </div>
	            </section>
	        </div>
	        <div class="col-xs-12 col-md-6">
	            <section class="section-padding price-area" id="review">
	                <div class="row">
	                    <div class="col-xs-12">
	                        <div class="page-title text-center">
	                            <h3 class="title">Review</h3>
	                        </div>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-xs-12 col-sm-12">
	                        <div class="price-box">
	                            <div class="price-body">
	                    			@if(isset($review))
	                    			<a href="review/{{$movie->id}}">
	                            	<span>Most Liked Review by {{$review->name}}</span>
	                                <p>
	                                	{{$review->review}}
	                                </p>
	                                </a>
	                                @else
	                        		<span>No review for the movie at this moment.</span>
	                                @endif
	                            </div>
	                            <div class="price-footer">
	                                <a href="/movie/{{$movie->id}}/review" class="bttn-white">@if(isset($review)) Check other review @else Write the first review @endif</a>
	                            </div>
	                        </div>
	                        <div class="space-30 hidden visible-xs"></div>
	                    </div>
	                </div>
	            </section>
	        </div>
	    </div>
	</div>
	<!-- Forum-Review-Area-End-->
@endsection
@push('scripts')
<script type="text/javascript">
	$( document ).ready(function() {
		if({!! json_encode($stats->times_played) <= 0 !!}){
			console.log('dsfsdf');
			$('#rating_section').css('display','none');
		}
    	if($("#review .price-body").height() > $("#forum .price-body").height()) $("#forum .price-body").height($("#review .price-body").height());
    	else $("#review .price-body").height($("#forum .price-body").height())
	});
</script>
@endpush
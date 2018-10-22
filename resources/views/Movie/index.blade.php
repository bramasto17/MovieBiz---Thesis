@extends('Layout/master')
@section('Title')
{{$movie->title}} [{{$movie->release_date->year}}]
@endsection
@section('Content')
	<!-- Home-Area -->
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
	                </div>
	                <div class="detail wow fadeInUp" data-wow-delay="0.6s">
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Release : </span>
	                        <span>{{$movie->release_date->format('d M Y')}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Language : </span>
	                        <span>{{$movie->original_language}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Country : </span>
	                        <span>{{$movie->production_countries[0]['name']}}</span>
	                    </div>
	                    <div class="col-xs-6 col-sm-4">
	                        <span class="red-color">Directors : </span>
	                        <span>{{$movie->casts['crew'][0]['name']}}</span>
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
	                <div class="row movie-menu">
		                <div class="col-xs-12 col-sm-4">
                    		<div class="space-20"></div>
		                    	<button id="checkInMovie" class="bttn-white wow fadeInUp" data-wow-delay="0.8s"><i class="lnr lnr-film-play"></i>{{isset($isWatch) ? 'Watch Again' : 'Chek-In Movie'}}</button>
		                </div>
		                <div class="col-xs-12 col-sm-8 wow fadeInUp">
		                	<div class="row">
		                    	<span class="red-color">Your Rating: <span class="lnr lnr-checkmark-circle" id="message"></span> </span>
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
		                	</div>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
	<!-- Home-Area-End -->
	<!--Price-Area -->
	<section class="section-padding info" id="price_page">
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
	                            <span>290</span>
	                        </div>
	                        <h4>user watched</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>30</span>
	                        </div>
	                        <h4>friends watched</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>190</span>
	                        </div>
	                        <h4>times played</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	            <div class="col-xs-12 col-sm-3">
	                <div class="price-box">
	                    <div class="price-header">
	                        <div class="price-icon">
	                            <span>8.8</span>
	                        </div>
	                        <h4>overall rating</h4>
	                    </div>
	                </div>
	                <div class="space-30 hidden visible-xs"></div>
	            </div>
	        </div>
	    </div>
	</section>
	<!--Price-Area-End -->
	<!-- Testimonial-Area -->
	<section class="testimonial-area" id="testimonial_page">
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
			                    <img src="https://image.tmdb.org/t/p/w138_and_h175_face{{$cast['profile_path']}}" alt="" onerror="this.onerror=null;this.src='{{ URL::to('/') }}/images/person.png';">
			                </div>
			        		<div class="col-xs-8">            			
			                    <h4>{{$cast['name']}}</h4>
			                    <span>{{$cast['character']}}</span>
			        		</div>
			            </div>
                	@else
                		<div class="col-xs-4 team-box more hidden">
			        		<div class="col-xs-4">
			                    <img src="https://image.tmdb.org/t/p/w138_and_h175_face{{$cast['profile_path']}}" alt="" onerror="this.onerror=null;this.src='{{ URL::to('/') }}/images/person.png';">
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
	<!-- Testimonial-Area-End -->
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12 col-md-4">
	            <section class="section-padding price-area" id="price_page">
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
	                                    <li>Non Spoiler Discussion </li>
	                                    <li>Spoiler Discussion</li>
	                                    <li>Fan Theory</li>
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
	        <div class="col-xs-12 col-md-8">
	            <section class="section-padding price-area" id="price_page">
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
	                            	<span>Most Liked Review by {{$review->name}}</span>
	                                <p>
	                                	{{$review->review}}
	                                </p>
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
@endsection
@extends('Layout.master')
@section('Title')
{{$movie->title}} [{{$movie->release_date->year}}] Review
@endsection
@section('Content')
	<section class="overlay no-scroll" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat center center fixed; background-size: cover;" id="reviews-section">
		<div class="space-80"></div>

		
		<div class="container">
			<h4><a href="/movie/{{$movie->id}}"><span class="lnr lnr-arrow-left-circle"></span> Back to info</a></h4>
			<div class="col-xs-12 col-md-3">
				<figure class="wow fadeInUp" data-wow-delay="0.2s">
			        <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$movie->poster_path}}" alt="">
                    <div class="space-30"></div>
		    		<h3 align="center">{{$movie->title}}</h3>
                    <h4 align="center">({{count($allReviews) + (isset($myReview) ? 1 : 0)}} Reviews)</h4>
			    </figure>
			</div>  
			<div class="col-xs-12 col-md-9" id="">
				<div id="comments">
		            <ul class="comments-list">
                        @if($isWatch)
                        @if($myReview)
                        <li class="border-round-white.">
                            <article class="comment">
                                <form action="/editReviewMovie" method="post" class="comment-form">
                                    {{csrf_field()}}
                                    <figure class="comment-pic">
                                        <img alt="" src="{{ URL::to('/').\Auth::user()->profile_pict }}">
                                    </figure>
                                    <div class="comment-content">
                                        <div class="comment-header">
                                            <h4>Review by you <small>{{$myReview->created_at}}</small></h4>
                                            <p class="comment-date"><span class="review-rating"> {{$myReview->rating}}/10 <span class="icon">★</span></span></p>
                                        </div>

                                        <input type="hidden" name="movieId" value="{{$movie->id}}">
                                        <input type="hidden" name="id" value="{{$myReview->id}}">
                                        <textarea name="review" id="review" rows="5" class="form-control" placeholder="Write your review here">{{$myReview->review}}</textarea>

                                        <div align="right">
                                            <button type="submit" class="bttn-default bttn-half-padding">
                                                Change review
                                            </button>
                                            <button type="submit" formaction="/deleteReviewMovie" class="bttn-default bttn-half-padding">
                                                <i class="fa fa-trash fa-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </article>
                        </li>
                        @else
                        <div class="comment-respond" id="post-review">
                            <form action="/reviewMovie" method="post" class="comment-form">
                                {{csrf_field()}}
                                <input type="hidden" name="movieId" value="{{$movie->id}}">

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

                                <textarea name="review" id="review" rows="5" class="form-control" placeholder="Write your review here"></textarea>
                                <div class="space-30"></div>

                                <div align="right">
                                    <button type="submit" class="bttn-default bttn-half-padding">Post Review</button>
                                </div>
                                <div class="space-40"></div>
                            </form>
                        </div>
                        @endif
                        @else
                        <div class="comment-respond">
                            <h4>You need to watch the movie first before give review</h4>
                        </div>
                        @endif

                        @foreach($allReviews as $review)
		                <li>
		                    <article class="comment">
		                        <figure class="comment-pic">
		                            <img alt="" src="{{ URL::to('/').$review->pict }}">
		                        </figure>
		                        <div class="comment-content">
		                            <div class="comment-header">
                                        <h4>Review by <a href="/profile/{{$review->userId}}">{{$review->userName}}</a> <small>{{$review->created_at}}</small></h4>
                                        <p class="comment-date"><span class="review-rating"> {{$review->rating}}/10 <span class="icon">★</span></span></p>
		                            </div>
		                            <p>{{$review->review}}</p>
		                        </div>
		                    </article>
		                </li>
		                @endforeach
		            </ul>
		        </div>

			</div>  	
		</div>

	</section>
@endsection
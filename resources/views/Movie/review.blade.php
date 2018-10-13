@extends('Layout/master')
@section('Title')
{{$movie->title}} [{{$movie->release_date->year}}] Review
@endsection
@section('Content')
	<section class="overlay no-scroll" style="background: url(https://image.tmdb.org/t/p/original{{$movie->backdrop_path}}) no-repeat center center fixed;" id="reviews-section">
		<div class="space-80"></div>

		
		<div class="container">
			<h4><a href="/movie/{{$movie->id}}"><span class="lnr lnr-arrow-left-circle"></span> Back to info</a></h4>
			<div class="col-xs-12 col-md-3">
				<figure class="wow fadeInUp" data-wow-delay="0.2s">
			        <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2{{$movie->poster_path}}" alt="">
                    <div class="space-30"></div>
		    		<h3 align="center">{{$movie->title}} Reviews</h3>
			    </figure>
			</div>  
			<div class="col-xs-12 col-md-9" id="">
				<div id="comments">
		            <h3 class="comment-heading">{{count($allReviews) + (isset($myReview) ? 1 : 0)}} Reviews</h3>
		            <ul class="comments-list">
                        @if($myReview)
                        <li class="border-round-white">
                            <article class="comment">
                                <form action="/editReviewMovie" method="post" class="comment-form">
                                    {{csrf_field()}}
                                    <figure class="comment-pic">
                                        <img alt="" src="{{ URL::to('/') }}/images/person.png">
                                    </figure>
                                    <div class="comment-content">
                                        <div class="comment-header">
                                            <h4>Reviewed by you <small>{{$myReview->created_at}}</small></h4>
                                            <p class="comment-date"><span class="review-rating"> {{$myReview->rating}}/10 <span class="icon">★</span></span></p>
                                        </div>
                                        <input type="hidden" name="movieId" value="{{$movie->id}}">
                                        <input type="hidden" name="id" value="{{$myReview->id}}">
                                        <textarea name="review" id="review" rows="5" class="form-control" placeholder="Write your review here">{{$myReview->review}}</textarea>
                                        <ul class="breadcrumb">
                                            <li>0 persons like your review</li>
                                        </ul>
                                    </div>

                                    <div align="right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-arrow-circle-right fa-lg"></i>
                                            Change Review
                                        </button>
                                        <button type="submit" formaction="/deleteReviewMovie" class="btn btn-danger">
                                            Delete Review
                                        </button>
                                    </div>
                                </form>
                            </article>
                        </li>
                        @endif

                        @foreach($allReviews as $review)
		                <li class="noborder-round">
		                    <article class="comment">
		                        <figure class="comment-pic">
		                            <img alt="" src="{{ URL::to('/') }}/images/person.png">
		                        </figure>
		                        <div class="comment-content">
		                            <div class="comment-header">
                                        <h4>Reviewed by {{$review->name}} <small>{{$review->created_at}}</small></h4>
                                        <p class="comment-date"><span class="review-rating"> {{$review->rating}}/10 <span class="icon">★</span></span></p>
		                            </div>
		                            <p>{{$review->review}}</p>
                                    <div align="right">
                                        <a href="#"><i class="fa fa-thumbs-up"> Like</i></a>
                                    </div>
		                        </div>
		                    </article>
		                </li>
		                @endforeach
		            </ul>
		        </div>

				@if(!$myReview)
	            <div class="comment-respond" id="post-review">
	                <h4>Post your review</h4>
	                <form action="/reviewMovie" method="post" class="comment-form">
						{{csrf_field()}}
						<input type="hidden" name="movieId" value="{{$movie->id}}">
	                    <textarea name="review" id="review" rows="5" class="form-control" placeholder="Write your review here"></textarea>
	                    <div class="space-30"></div>
	                    <center>
	                    	<button type="submit" class="bttn-default">Post Review</button>
	                    </center>
	                    <div class="space-80"></div>
	                </form>
	            </div>
				@endif

			</div>  	
		</div>

	</section>
@endsection
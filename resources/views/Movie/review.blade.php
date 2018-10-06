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
		    		<h3>{{$movie->title}} Reviews</h3>
		    		<h4><a href="#post-review">Post Your Review</a></h4>
			    </figure>
			</div>  
			<div class="col-xs-12 col-md-9" id="">
				<div id="comments">
		            <h3 class="comment-heading">{{count($reviews)}} Reviews</h3>
		            <ul class="comments-list">
		            	@foreach($reviews as $review)
		                <li>
		                    <article class="comment">
		                        <figure class="comment-pic">
		                            <img alt="" src="{{ URL::to('/') }}/images/person.png">
		                        </figure>
		                        <div class="comment-content">
		                            <div class="comment-header">
		                                <h4>Review by {{$review->name}}</h4>
		                                <p class="comment-date">Rating : <span class="review-rating"> {{$review->rating}} </span></p>
		                                <p class="comment-date">Review on {{$review->created_at}} </p>
		                            </div>
		                            <p>{{$review->review}}</p>
		                            <ul class="breadcrumb">
		                                <li><a href="#">Like</a></li>
		                            </ul>
		                        </div>
		                    </article>
		                </li>
		                @endforeach
		            </ul>
		        </div>
	            <div class="comment-respond" id="post-review">
	                <h4>Post your comments</h4>
	                <form action="/reviewMovie" method="post" class="comment-form">
						{{csrf_field()}}
						<input type="hidden" name="movieId" value="{{$movie->id}}"></input>
	                    <textarea name="review" id="review" rows="5" class="form-control" placeholder="Type Your Review..."></textarea>
	                    <div class="space-30"></div>
	                    <center>
	                    	<button type="submit" class="bttn-default">Post Review</button>
	                    </center>
	                    <div class="space-80"></div>
	                </form>
	            </div>
			</div>  	
		</div>
	</section>
@endsection
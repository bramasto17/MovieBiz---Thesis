<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;

use App\Rating;
use App\Review;
use App\Watch;

class MovieController extends Controller
{
    //
    public function index($id){
    	$movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);
        $rating = Rating::where('userId',Auth::user()->id)->where('movieId',$id)->first();
        $review = Review::join('users','users.id','=','reviews.userId')->where('movieId',$id)->select('reviews.*','users.name')->first();
        // dd($review);
        return view('Movie\index', compact('movie','rating','review'));
    }

    public function checkInMovie(Request $request){
        $watch = new Watch();
        $watch->userId = Auth::user()->id;
        $watch->movieId = $request->movieId;
        $watch->save();

        return json_encode(['message' => 'Success']);
    }

    public function ratingMovie(Request $request){
        // dd($request);
        $rating = Rating::where('userId',Auth::user()->id)->where('movieId',$request->movieId)->first();

        if($rating != null){
            $rating->rating = $request->rating;
            $rating->save();
        }
        else{
            $rating = new Rating();
            $rating->userId = Auth::user()->id;
            $rating->movieId = $request->movieId;
            $rating->rating = $request->rating;
            $rating->save();

        }
        // return redirect('/movie/'.$request->movieId);
        return json_encode(['message' => 'Success']);
    }

    public function reviewMovie(Request $request){
        $review = new Review();
        $review->userId = Auth::user()->id;
        $review->movieId = $request->movieId;
        $review->review = $request->review;
        $review->save();

        return redirect('/movie/'.$request->movieId.'/review');
    }

    public function showReview($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);
        $reviews = Review::join('users','users.id','=','reviews.userId')
                  ->join('ratings',function($join){
                    $join->on('reviews.userId','=','ratings.userId');
                    $join->on('reviews.movieId','=','ratings.movieId');
                  })
                  ->where('reviews.movieId',$id)->select('reviews.*','users.name','ratings.rating')->get();
        // dd($reviews);
        return view('Movie\review')->with(compact('movie','reviews'));
    }
}

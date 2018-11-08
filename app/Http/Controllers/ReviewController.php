<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Post;
use App\Threat;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Auth;
use Session;

use Carbon\Carbon;

use App\Rating;
use App\Review;
use App\Watch;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     *  REVIEW MOVIE
     */
    public function reviewMovie(Request $request){
        $inputs = Input::all();
        $rules = [
            'review' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $review = new Review();
            $review->userId = Auth::user()->id;
            $review->movieId = $request->movieId;
            $review->review = $request->review;
            $review->save();
        } else {
            return redirect('/movie/'.$request->movieId.'/review')->withErrors($validator);
        }

        return redirect('/movie/'.$request->movieId.'/review');
    }

    public function showReview($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);
        $rating = Rating::where('userId',Auth::user()->id)->where('movieId',$id)->first();
        $isWatch = Watch::where('userId',Auth::user()->id)->where('movieId',$id)->first();


        /*$reviews = Review::join('users','users.id','=','reviews.userId')
                  ->join('ratings',function($join){
                    $join->on('reviews.userId','=','ratings.userId');
                    $join->on('reviews.movieId','=','ratings.movieId');
                  })
                  ->where('reviews.movieId','=',$id)->select('reviews.*','users.name','ratings.rating')->get();*/

        $allReviews = DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.userId')
            ->join('ratings', function($join)
            {
                $join->on('ratings.userId', '=', 'reviews.userId');
                $join->on('ratings.movieId', '=', 'reviews.movieId');
            })
            ->where('reviews.movieId', '=', $movie->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->select('reviews.*','users.name','ratings.rating')
            ->get();

        // dd($allReviews);

        $myReview = DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.userId')
            ->join('ratings', function($join)
            {
                $join->on('ratings.userId', '=', 'reviews.userId');
                $join->on('ratings.movieId', '=', 'reviews.movieId');
            })
            ->where('reviews.movieId', '=', $movie->id)
            ->where('users.id', '=', Auth::user()->id)
            ->select('reviews.*','users.name','ratings.rating')
            ->first();

        // dd($myReview);

        return view('Movie\review', compact('movie','allReviews','myReview','isWatch','rating'));
    }

    public function editReview(Request $request){
        $target = Review::find($request->id);

        $inputs = Input::all();
        $rules = [
            'review' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $target->review = $request->review;
            $target->save();
        } else {
            return redirect('/movie/'.$request->movieId.'/review')->withErrors($validator);
        }

        return redirect('/movie/'.$request->movieId.'/review');
    }

    public function deleteReview(Request $request){
        DB::table('reviews')
            ->where('id', '=', $request->id)
            ->delete();

        return redirect('/movie/'.$request->movieId.'/review');
    }
}

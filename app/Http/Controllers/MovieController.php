<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Post;
use App\Thread;
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

class MovieController extends Controller
{
    //
    public function index($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);
        $rating = Rating::where('userId',Auth::user()->id)->where('movieId',$id)->first();
        $review = Review::join('users','users.id','=','reviews.userId')->where('movieId',$id)->select('reviews.*','users.name')->first();

        $isWatch = Watch::where('userId',Auth::user()->id)->where('movieId',$id)->count();
        $dis_users = Watch::where('movieId',$id)->selectRaw(DB::raw('COUNT(DISTINCT userId) as distinct_user'))->first();
        $dis_reviews = Review::where('movieId',$id)->selectRaw(DB::raw('COUNT(DISTINCT userId) as distinct_review'))->first();
        $dis_ratings = Rating::where('movieId',$id)->selectRaw(DB::raw('AVG(rating) as average_rating'))->first();
        $stats = array(
            'times_played' => isset($isWatch) ? $isWatch : '0',
            'users_played' => $dis_users->distinct_user,
            'total_review' => $dis_reviews->distinct_review,
            'avg_rating' => number_format((float)$dis_ratings->average_rating, 1, '.', ''),
        );
        $stats = (object) $stats;

        $similars = tmdb()->similarMovies($id);
        foreach ($similars as $key => $s) {
            if ($key <= 11) {
                $similar[] = (object) $s->get();
            }
        }

        $forum = Forum::where('movieId',$id)->first();
        $threads = Thread::where('forumId',$forum->id)->take(3)->get();
        
        return view('Movie\index', compact('movie','rating','review','stats','similar','threads'));
    } 
}

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

        return view('Movie\index', compact('movie','rating','review','stats'));
    }

    public function checkInMovie(Request $request){
        $watch = new Watch();
        $watch->userId = Auth::user()->id;
        $watch->movieId = $request->movieId;
        $watch->save();

        $history = Session::get('history');
        $history_new = (object) tmdb()->getMovie($watch->movieId)->get();
        $history[] = $history_new;
        Session::put('history', $history);

        return json_encode(['message' => 'Success']);
    }

    public function ratingMovie(Request $request){
        // dd($request);
        $rating = Rating::where('userId',Auth::user()->id)
            ->where('movieId',$request->movieId)
            ->first();

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

    /**
     *  FORUM
     */
    public function showForum($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $forum = Forum::where('movieID','=', $id)->first();
        if (!$forum) {
            $new = new Forum();
            $new->movieID = $id;
            $new->save();
        }

        $forum = Forum::where('movieID','=', $id)->first();
        $threads = DB::table('threats')
            ->join('users', 'users.id', '=', 'threats.creatorId')
            ->join('forums', 'forums.id', '=', 'threats.forumId')
            ->where('threats.forumId', '=', $forum->id)
            ->select('threats.*', 'users.name', 'forums.movieId')
            ->get();

        return view('Movie\forum', compact('movie', 'threads', 'forum'));
    }

    public function createThread(Request $request){
        $inputs = Input::all();
        $rules = [
            'title' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $new = new Threat();
            $new->forumId = $request->forumId;
            $new->creatorId = $request->creatorId;
            $new->title = $request->title;
            $new->category = $request->category;
            $new->save();
        } else {
            return redirect('/movie/'.$request->movieId.'/forum')->withErrors($validator);
        }

        return redirect('/movie/'.$request->movieId.'/forum');

    }

    public function showThreadDetail($id){
        $thisThread =DB::table('threats')
            ->join('users', 'users.id', '=', 'threats.creatorId')
            ->join('forums', 'forums.id', '=', 'threats.forumId')
            ->where('threats.id', '=', $id)
            ->select('threats.*', 'users.name', 'forums.movieId')
            ->first();

        $movie =(object) tmdb()->getMovie($thisThread->movieId)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threats', 'threats.id', '=', 'posts.threatId')
            ->where('posts.threatId', '=', $id)
            ->where('posts.subpost', '=', null)
            ->select('posts.*', 'users.name')
            ->get();

        $subposts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threats', 'threats.id', '=', 'posts.threatId')
            ->where('posts.threatId', '=', $id)
            ->where('posts.subpost', '!=', null)
            ->select('posts.*', 'users.name')
            ->get();

        return view('Movie\forum-detail', compact('movie', 'thisThread', 'posts', 'subposts'));
    }

    public function createPost(Request $request){
        //dd($request);

        $inputs = Input::all();
        $rules = [
            'txtContent' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $new = new Post();
            $new->threatId = $request->threatId;
            $new->userId = $request->userId;
            $new->content = $request->txtContent;

            if ($request->subpost != null){
                $new->subpost = $request->subpost;
            }
            else {
                $new->subpost = null;
            }
            $new->save();

        } else {
            return redirect('/thread/'.$request->threatId)->withErrors($validator);
        }

        return redirect('/thread/'.$request->threatId);

    }
}

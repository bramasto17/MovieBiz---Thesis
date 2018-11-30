<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use App\Following;
use App\User;
use App\Timeline;
use App\Rating;
use App\Review;
use App\Watch;
use Carbon\Carbon;
use Auth;
class ProfileController extends Controller
{
    //
    public function checkFollowing($followerId,$followTargetId){

    	$temp = DB::table('followings')->where('userId',$followerId)->where('followingId',$followTargetId)->get();
    	if($temp->isEmpty()){
    		return false;
    	}else{
    		return true;
    	}	
    }

    public function index($id){
        $user = User::where('id',$id)->first();
        $currentUser = Auth::user()->id;
        $isFollowing = $this->checkFollowing($currentUser,$id);
        $isOwnAccount = $user->id == $currentUser ? true : false;
        $history = Watch::where('userId',$id)->orderBy('created_at','desc')->first();
        $profile_header = (object) array(
                          'timeline' => Timeline::where('userId',$id)->count(),
                          'following' => Following::where('userId',$id)->count(),
                          'followers' => Following::where('followingId',$id)->count()
                          );
        // dd($profile_header);

        $mosts = Watch::where('userId',$id)
                 ->select(DB::raw('movieId, COUNT(movieId) as total'))
                 ->groupBy(DB::raw('movieId'))
                 ->orderBy('total','desc')
                 ->orderBy('created_at','desc')
                 ->take(8)
                 ->get();

        $total =  Watch::where('userId',$id)->count();
        $movies = Watch::where('userId',$id)->selectRaw(DB::raw('COUNT(DISTINCT movieId) as distinct_movie'))->first();
        $average = Rating::where('userId',$id)->selectRaw(DB::raw('AVG(rating) as average_rating'))->first();
        $rating_top = Rating::where('userId',$id)->orderBy('rating','desc')->take(3)->get();
        $reviews = Review::where('userId',$id)->count();

        $user_data = array(
                    'total' => $total,
                    'movies' => $movies->distinct_movie,
                    'average' => number_format((float)$average->average_rating, 1, '.', ''),
                    'reviews' => $reviews
              );
        $user_data = (object) $user_data;
        return view('profile.activity', compact('user', 'isFollowing', 'isOwnAccount', 'history', 'profile_header', 'mosts', 'user_data', 'rating_top'));
    }

    public function timeline($id){
        $user = User::where('id',$id)->first();
        $currentUser = Auth::user()->id;
        $isFollowing = $this->checkFollowing($currentUser,$id);
        $isOwnAccount = $user->id == $currentUser ? true : false;
        $history = Watch::where('userId',$id)->orderBy('created_at','desc')->first();
        $profile_header = (object) array(
                          'timeline' => Timeline::where('userId',$id)->count(),
                          'following' => Following::where('userId',$id)->count(),
                          'followers' => Following::where('followingId',$id)->count()
                          );

        $timelines = Timeline::where('userId',$id)->orderBy('created_at','desc')->get();
        return view('Profile.timeline', compact('user', 'isFollowing', 'isOwnAccount', 'history', 'profile_header', 'timelines'));
    }

    public function following($id){
        $user = User::where('id',$id)->first();
        $currentUser = Auth::user()->id;
        $isFollowing = $this->checkFollowing($currentUser,$id);
        $isOwnAccount = $user->id == $currentUser ? true : false;
        $history = Watch::where('userId',$id)->orderBy('created_at','desc')->first();
        $profile_header = (object) array(
                          'timeline' => Timeline::where('userId',$id)->count(),
                          'following' => Following::where('userId',$id)->count(),
                          'followers' => Following::where('followingId',$id)->count()
                          );

        $followings = Following::where('userId',$id)->get();

        return view('Profile.following', compact('user', 'isFollowing', 'isOwnAccount','history', 'profile_header','followings'));
    }

    public function followers($id){
        $user = User::where('id',$id)->first();
        $currentUser = Auth::user()->id;
        $isFollowing = $this->checkFollowing($currentUser,$id);
        $isOwnAccount = $user->id == $currentUser ? true : false;
        $history = Watch::where('userId',$id)->orderBy('created_at','desc')->first();
        $profile_header = (object) array(
                          'timeline' => Timeline::where('userId',$id)->count(),
                          'following' => Following::where('userId',$id)->count(),
                          'followers' => Following::where('followingId',$id)->count()
                          );

        $followers = Following::where('followingId',$id)->get();

        return view('Profile.followers', compact('user', 'isFollowing', 'isOwnAccount','history', 'profile_header','followers'));
    }

    public function follow(Request $request){
    	//dd($request);
    	$followerId = $request->followerID;
    	$followTargetId = $request->followTargetID;   	
    	
    	if($this->checkFollowing($followerId,$followTargetId)){
    		DB::table('followings')->where('userId',$followerId)->where('followingId',$followTargetId)->delete();
    		return "Follow";
    	}else{
    		DB::table('followings')->insert([
                'userId' => $followerId,
                'followingId'=>$followTargetId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
              ]);
    		return "Following";
    	}
    }

    public function editProfile(Request $request){
        dd($request);
    }

}

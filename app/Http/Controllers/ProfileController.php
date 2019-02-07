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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        if ($user == null) return redirect('/404');
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
        if ($user == null) return redirect('/404');
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
        if ($user == null) return redirect('/404');
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
        if ($user == null) return redirect('/404');
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
        $inputs = Input::all();
        $rules = [
            'profile_pict' => 'image',
            'name' => 'required',
            'password' => 'required | min: 5'
        ];
        $message = [
            'profile_pict.image' => 'Profile picture must be a valid image',
            'name.required' => 'Name is required',
            'password.min' => 'Password should consists atleast 5 characters',
            'password.required' => 'Password is required',
        ];
        $validator = Validator::make($inputs, $rules, $message);

        if ($validator->passes()) {
            $target = User::find($request->userId);

            if ($request->profile_pict != null){
                $file = $request->profile_pict;
                $file_name = $file->getClientOriginalName();
                $file->move("images/users/", $file_name);
                $target->profile_pict =  'images/users/'.$file_name;
            }

            $target->name = $request->name;
            $target->password = app('hash')->make($request->password);
            $target->save();
        }
        else{
            return redirect('/profile/'.$request->userId)->withErrors($validator);
        }

        return redirect('/profile/'.$request->userId);

    }

    public function viewChangePasswordForm(){
        return view('Profile.changepass');
    }

    public function changePassword(Request $request){
        //dd($request);
        if (!(Hash::check($request->get('txtCurrPass'), Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('txtCurrPass'), $request->get('txtNewPass')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        if(!(strcmp($request->get('txtNewPass'), $request->get('txtConfirmPass'))) == 0){
            return redirect()->back()->with("error","New password does not match the confirm password");
        }

        $rules = [
            'txtCurrPass' => 'required',
            'txtNewPass' => 'required | min:5 | alpha_num'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            $user->password = app('hash')->make($request->txtNewPass);
            $user->save();
            return redirect()->back()->with("success","Password changed successfully!");
        }

    }
}

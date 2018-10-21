<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use App\User;
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

    	return view('Profile.index')->with(['user'=>$user,'isFollowing'=>$isFollowing]);
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

    

}

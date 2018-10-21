<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use App\User;
use Carbon\Carbon;
class ProfileController extends Controller
{
    //
    public function index($id){
    	$user = User::where('id',$id)->first();
    	return view('Profile.index')->with(['user'=>$user]);
    }

    public function follow(Request $request){
    	//dd($request);
    	$followerId = $request->followerID;
    	$followTargetId = $request->followTargetID;   	
    	$temp = DB::table('followings')->where('userId',$followerId)->where('followingId',$followTargetId)->get();

    	if($temp->isEmpty()){
    		DB::table('followings')->insert([
                'userId' => $followerId,
                'followingId'=>$followTargetId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
              ]);
    	}else{
    		$temp->delete();
    		return "Follow";
    	}

    	return "Followed";
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\Following;
use App\Timeline;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    //

    public function getFollowingIds(){
    	$following = Following::where('userId',Auth::user()->id)->get();

    	foreach ($following as $f) {
    		$ids[] = $f->followingId;
    	}

    	return isset($ids) ? $ids : '0';
	}

    public function index(){
        $popular = Session::get('popular');
    	$movie = $popular[0];

    	$timelines = Timeline::whereIn('userId',$this->getFollowingIds())->orderBy('created_at','desc')->get();

    	return view('Feed.index', compact('movie', 'timelines'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Watch;

class ActivityController extends Controller
{
    public function index(){
    	$movieId = Watch::where('userId',Auth::user()->id)->get()->sortByDesc('created_at');
		$history = (object) tmdb()->getMovie($movieId[0]->movieId)->get();

		return view('activity.index')->with(['history'=>$history]);
    }

    public function getActivity(){
        $activity = \DB::table('watches')
                 ->select(DB::raw('CAST(created_at as date) as date, COUNT(movieId) as total'))
                 ->groupBy(DB::raw('CAST(created_at as date)'))
                 ->get();

        return json_encode($activity);
    }
    //
}

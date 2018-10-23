<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Watch;

class ActivityController extends Controller
{
    public function index(){
    	$history = Watch::where('userId',Auth::user()->id)->orderBy('created_at','desc')->get();

      $mosts = Watch::where('userId',\Auth::user()->id)
                 ->select(DB::raw('movieId, COUNT(movieId) as total'))
                 ->groupBy(DB::raw('movieId'))
                 ->orderBy('total','desc')
                 ->take(8)
                 ->get();

        foreach ($history as $key => $a) {
          if($a->movieId != $history[($key-1 < 0) ? 0: $key-1]->movieId){ 
            $gs = $a->movie()->genres;
            foreach ($gs as $g) {
              isset($genres[$g['name']]) ? $genres[$g['name']] += 1 : $genres[$g['name']] = 1;
            }
          }
        }
          // dd($total_movies);

        // dd($history[0]->movie()->backdrop_path);

		  return view('activity.index')->with(['history'=>$history, 'mosts'=>$mosts, 'genres'=>$genres]);
    }

    public function getActivity(){
        $activities = \DB::table('watches')
                 ->select(DB::raw('CAST(created_at as date) as date, COUNT(movieId) as total'))
                 ->where('userId',\Auth::user()->id)
                 ->groupBy(DB::raw('CAST(created_at as date)'))
                 ->get();
                 
        foreach ($activities as $a) {
            $a->date = date('d', strtotime($a->date));
            $activity[] = $a;
        }

        return json_encode($activity);
    }
    //
}

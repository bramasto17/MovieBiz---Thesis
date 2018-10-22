<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Watch;

class ActivityController extends Controller
{
    public function index(){
    	$movieId = Watch::where('userId',Auth::user()->id)->orderBy('created_at','desc')->get();
      if(count($movieId) != 0){
        $history = (object) tmdb()->getMovie($movieId[0]->movieId)->get();
      }
      else $history = null;

      // $ids = \DB::table('watches')
      //            ->select(DB::raw('movieId, movieId as title, COUNT(movieId) as total'))
      //            ->where('userId',\Auth::user()->id)
      //            ->groupBy(DB::raw('movieId'))
      //            ->orderBy('total','desc')
      //            ->get();
      // foreach ($ids as $id) {
      //   $most =(object) tmdb()->getMovie($id->movieId)->get();
      //   $most->setAttribute('count', $id->total);
      //   dd($most);
      // }

		  return view('activity.index')->with(['history'=>$history]);
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

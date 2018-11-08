<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Rating;
use App\Review;
use App\Watch;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(){
      $history = Watch::where('userId',Auth::user()->id)->orderBy('created_at','desc')->first();
      // dd(isset($history));

      $mosts = Watch::where('userId',\Auth::user()->id)
                 ->select(DB::raw('movieId, COUNT(movieId) as total'))
                 ->groupBy(DB::raw('movieId'))
                 ->orderBy('total','desc')
                 ->orderBy('created_at','desc')
                 ->take(8)
                 ->get();

      $total =  Watch::where('userId',Auth::user()->id)->count();
      $movies = Watch::where('userId',Auth::user()->id)->selectRaw(DB::raw('COUNT(DISTINCT movieId) as distinct_movie'))->first();
      $average = Rating::where('userId',Auth::user()->id)->selectRaw(DB::raw('AVG(rating) as average_rating'))->first();
      $rating_top = Rating::where('userId',Auth::user()->id)->orderBy('rating','desc')->take(3)->get();
      $reviews = Review::where('userId',Auth::user()->id)->count();

      $user = array(
                'total' => $total,
                'movies' => $movies->distinct_movie,
                'average' => number_format((float)$average->average_rating, 1, '.', ''),
                'reviews' => $reviews
              );
      $user = (object) $user;

		  return view('activity.index')->with(['history'=>$history, 'mosts'=>$mosts, 'user'=>$user, 'rating_top'=>$rating_top]);
    }

    public function getActivity(){

      $start = Carbon::now()->subDays(29);
      for ($i = 0 ; $i <= 29; $i++) {
        $dates[] = $start->copy()->addDays($i)->toDateString();
      }

      foreach ($dates as $date) {
        $q = \DB::table('watches')
            ->where('userId',\Auth::user()->id)
            ->where('created_at','>=',$date.' 00:00:00')
            ->where('created_at','<=',$date.' 23:59:59')
            ->count();
        $obj = array('date' => $date, 'total' => $q );
        $activity[] = $obj;
      }
               
      // foreach ($activities as $a) {
      //     $a->date = date('d', strtotime($a->date));
      //     $activity[] = $a;
      // }
      return json_encode($activity);
    }

    public function getFavouriteGenres(){
      $history = Watch::where('userId',Auth::user()->id)->orderBy('created_at','desc')->get();
      $total_genres = 0;

      foreach ($history as $key => $a) {
        if($a->movieId != $history[($key-1 < 0) ? 0: $key-1]->movieId){ 
          $gs = $a->movie()->genres;
          foreach ($gs as $g) {
            isset($gnr[$g['name']]) ? $gnr[$g['name']] += 1 : $gnr[$g['name']] = 1;
            $total_genres+=1;
          }
        }
      }

      foreach ($gnr as $key => $g) {
        $obj = array(
                  'label' => $key,
                  'count' => $g,
                  'percentage' => round($g/$total_genres*100),
               );
        $obj = (object) $obj;
        $genres[] = $obj;
      }
      return json_encode($genres);
    }
    //
}

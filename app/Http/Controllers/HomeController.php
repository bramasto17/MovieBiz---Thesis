<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

use App\Watch;
use App\Timeline;
use App\User;
class HomeController extends Controller
{
    //
    public function index(Request $request){
        if(!Session::has('popular')){
            $populars = tmdb()->getDiscoverMovie();
            foreach ($populars as $p) {
                $popular[] = (object) $p->get();
            }
            Session::put('popular', $popular);
        }
        $popular = Session::get('popular');
        if(auth()->guest()){
            return view('index')->with(['popular1'=>$popular[rand(0,19)], 'popular2'=>$popular[rand(0,19)]]);
        }
        else{
            return redirect('/home');
        }
    }

    public function home(Request $request){
        $popular = Session::get('popular');
        $feeds = Timeline::whereIn('userId',getFollowingIds())->orderBy('created_at','desc')->take(5)->get();
        $timelines = Timeline::where('userId',\Auth::user()->id)->orderBy('created_at','desc')->take(5)->get();
        return view('Home/index')->with(['popular'=>$popular, 'feeds'=>$feeds, 'timelines'=>$timelines]);
    }

    public function discover(Request $request){
        ini_set('max_execution_time', 6000);
        //POPULAR
        $popular = Session::get('popular');

        //LATEST
        if(!Session::has('latest')){
            $latests = tmdb()->nowPlayingMovies();
            foreach ($latests as $l) {
                $latest[] = (object) $l->get();
            }
            Session::put('latest', $latest);
        }
        $latest = Session::get('latest');

        //HISTORY
        if(!Session::has('history')){
            $movieId = Watch::where('userId',Auth::user()->id)->get()->sortByDesc('created_at');
            foreach ($movieId as $key => $data) {
                // $time_start = microtime(true); 
                $history[] = (object) tmdb()->getMovie($data->movieId)->get();
                // $time_end = microtime(true); 
                // $exe[] = $time_end - $time_start;
            }
            Session::put('history', isset($history) ? $history : null);
        }
        $history = Session::get('history');
        return view('Discover/index')->with(['popular'=>$popular,'latest'=>$latest, 'history'=>$history]);
    }

    public function search(Request $request){
        $txtSearch = $request->txtSearch;
        $movies = tmdb()->searchMovie($txtSearch);
        $users = User::where('name','LIKE','%'.$txtSearch.'%')->select('id','name','profile_pict')->get();
        return view('Search/index')->with(['movies'=>$movies, 'search'=>$txtSearch,'users'=>$users]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

use App\Watch;
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
            return view('index')->with(['popular'=>$popular]);
        }
        else{
            return redirect('/home');
        }
    }

    public function home(Request $request){
        $popular = Session::get('popular');
        $latest = Session::get('popular');

        $movieId = Watch::where('userId',Auth::user()->id)->get()->sortByDesc('created_at');
        
        $history = null;
        foreach ($movieId as $key => $data) {
            $history[] = (object) tmdb()->getMovie($data->movieId)->get();
        }
        // dd($history[0]->id);
        return view('Home/index')->with(['popular'=>$popular,'latest'=>$latest, 'history'=>$history]);
    }

    public function search(Request $request){
        $txtSearch = $request->txtSearch;
        $movies = tmdb()->searchMovie($txtSearch);

        $users = User::where('name','LIKE','%'.$txtSearch.'%')->select('id','name')->get();
        
        // foreach ($search as $key => $data) {
        //     $movies[] = (object) $data->get();
        // }

        return view('Search/index')->with(['movies'=>$movies, 'search'=>$txtSearch,'users'=>$users]);
    }

}

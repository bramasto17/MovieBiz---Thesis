<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Post;
use App\Threat;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Auth;
use Session;

use Carbon\Carbon;

use App\Rating;
use App\Review;
use App\Timeline;
use App\Watch;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class WatchController extends Controller
{
    public function checkInMovie(Request $request){
        $watch = new Watch();
        $watch->userId = Auth::user()->id;
        $watch->movieId = $request->movieId;
        $watch->save();

        $history = Session::get('history');
        $watch_movie = (object) tmdb()->getMovie($watch->movieId)->get();
        $history[] = $watch_movie;
        Session::put('history', $history);

        $timeline = new Timeline();
        $timeline->userId = Auth::user()->id;
        $timeline->text = "I'm currently watching " . $watch_movie->title;
        $timeline->save();

        return json_encode(['message' => 'Success']);
    }
}

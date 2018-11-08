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
        $history_new = (object) tmdb()->getMovie($watch->movieId)->get();
        $history[] = $history_new;
        Session::put('history', $history);

        return json_encode(['message' => 'Success']);
    }
}

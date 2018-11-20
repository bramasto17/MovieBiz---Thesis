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

class ForumController extends Controller
{
    public function showForum($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $forum = Forum::where('movieID','=', $id)->first();
        if (!$forum) {
            $new = new Forum();
            $new->movieID = $id;
            $new->save();
        }

        $forum = Forum::where('movieID','=', $id)->first();
        $threads = DB::table('threats')
            ->join('users', 'users.id', '=', 'threats.creatorId')
            ->join('forums', 'forums.id', '=', 'threats.forumId')
            ->where('threats.forumId', '=', $forum->id)
            ->select('threats.*', 'users.name', 'forums.movieId')
            ->get();

        return view('Movie\forum', compact('movie', 'threads', 'forum'));
    }

    public function createThread(Request $request){
        $inputs = Input::all();
        $rules = [
            'title' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $new = new Threat();
            $new->forumId = $request->forumId;
            $new->creatorId = $request->creatorId;
            $new->title = $request->title;
            $new->save();
        } else {
            return redirect('/movie/'.$request->movieId.'/forum')->withErrors($validator);
        }

        return redirect('/movie/'.$request->movieId.'/forum');

    }

    public function showThreadDetail($id){
        $thisThread =DB::table('threats')
            ->join('users', 'users.id', '=', 'threats.creatorId')
            ->join('forums', 'forums.id', '=', 'threats.forumId')
            ->where('threats.id', '=', $id)
            ->select('threats.*', 'users.name as userName', 'users.id as userId','forums.movieId')
            ->first();

        $movie =(object) tmdb()->getMovie($thisThread->movieId)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threats', 'threats.id', '=', 'posts.threatId')
            ->where('posts.threatId', '=', $id)
            ->where('posts.subpost', '=', null)
            ->select('posts.*', 'users.name as userName', 'users.id as userId')
            ->get();

        $subposts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threats', 'threats.id', '=', 'posts.threatId')
            ->where('posts.threatId', '=', $id)
            ->where('posts.subpost', '!=', null)
            ->select('posts.*', 'users.name as userName', 'users.id as userId')
            ->get();

        return view('Movie\forum-detail', compact('movie', 'thisThread', 'posts', 'subposts'));
    }

    public function createPost(Request $request){
        //dd($request);

        $inputs = Input::all();
        $rules = [
            'txtContent' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $new = new Post();
            $new->threatId = $request->threatId;
            $new->userId = $request->userId;
            $new->content = $request->txtContent;

            if ($request->subpost != null){
                $new->subpost = $request->subpost;
            }
            else {
                $new->subpost = null;
            }
            $new->save();

        } else {
            return redirect('/thread/'.$request->threatId)->withErrors($validator);
        }

        return redirect('/thread/'.$request->threatId);

    }
}

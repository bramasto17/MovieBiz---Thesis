<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Post;
use App\Thread;
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

class ThreadController extends Controller
{
    public function index($id){
        $movie =(object) tmdb()->getMovie($id)->get();
        if (!property_exists($movie, 'release_date')) return redirect('/404');
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $forum = Forum::where('movieID','=', $id)->first();
        if (!$forum) {
            $new = new Forum();
            $new->movieID = $id;
            $new->save();
        }

        $forum = Forum::where('movieID','=', $id)->first();
        $threads = DB::table('threads')
            ->join('users', 'users.id', '=', 'threads.creatorId')
            ->join('forums', 'forums.id', '=', 'threads.forumId')
            ->leftJoin('posts', 'posts.threadId', '=', 'threads.id')
            ->where('threads.forumId', '=', $forum->id)
            ->select(DB::raw('threads.id, threads.title, users.name, forums.movieId, COUNT(posts.id) as posts'))
            ->groupBy(DB::raw('threads.id, threads.title, users.name, forums.movieId'))
            ->get();
        // ->select('threads.*', 'users.name', 'forums.movieId', 'posts.id')
         //dd($threads);
        return view('Movie\Thread\index', compact('movie', 'threads', 'forum'));
    }

    public function createThread(Request $request){
        $inputs = Input::all();
        $rules = [
            'title' => 'required'
        ];
        $validator = Validator::make($inputs, $rules);

        if($validator->passes()){
            $new = new Thread();
            $new->forumId = $request->forumId;
            $new->creatorId = $request->creatorId;
            $new->title = $request->title;
            $new->save();
        } else {
            return redirect('/movie/'.$request->movieId.'/forum')->withErrors($validator);
        }

        return redirect('/thread/'.$new->id);

    }

    public function showThreadDetail($id){
        $thisThread =DB::table('threads')
            ->join('users', 'users.id', '=', 'threads.creatorId')
            ->join('forums', 'forums.id', '=', 'threads.forumId')
            ->where('threads.id', '=', $id)
            ->select('threads.*', 'users.name as userName', 'users.id as userId', 'forums.movieId')
            ->first();

        if ($thisThread == null) return redirect('/404');

        $movie =(object) tmdb()->getMovie($thisThread->movieId)->get();
        $movie->release_date = Carbon::createFromFormat('Y-m-d', $movie->release_date);

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threads', 'threads.id', '=', 'posts.threadId')
            ->where('posts.threadId', '=', $id)
            ->where('posts.subpost', '=', null)
            ->select('posts.*', 'users.name as userName', 'users.id as userId')
            ->get();

        $subposts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.userId')
            ->join('threads', 'threads.id', '=', 'posts.threadId')
            ->where('posts.threadId', '=', $id)
            ->where('posts.subpost', '!=', null)
            ->select('posts.*', 'users.name as userName', 'users.id as userId')
            ->get();

        $creator = (\Auth::user()->id == $thisThread->creatorId) ? true : false;

        return view('Movie\Thread\detail', compact('movie', 'thisThread', 'posts', 'subposts','creator'));
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
            $new->threadId = $request->threadId;
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
            return redirect('/thread/'.$request->threadId)->withErrors($validator);
        }

        return redirect('/thread/'.$request->threadId);

    }
}

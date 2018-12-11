<?php

namespace App\Http\Controllers;

use App\Post;
use App\Forum;
use App\Review;
use App\Thread;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function banUser($id){
        $user = User::where('id',$id)->first();
        $user->active = ($user->active == 1) ? 0 : 1;
        $user->save();
        return redirect('profile/'.$id);
    }

    public function deletePost($id){
        $post = Post::where('id',$id)->first();
        $post->delete();
        return redirect('thread/'.$post->threadId);
    }

    public function deleteThread($id){
        $thread = Thread::where('id',$id)->first();
        $forum = Forum::where('id',$thread->forumId)->first();
        $movieId = $forum->movieId;
        $thread->delete();
        return redirect('movie/'.$movieId.'/forum');
    }

    public function deleteReview($id){
        $review = Review::where('id',$id)->first();
        $movieId = $review->movieId;
        $review->delete();
        return redirect('movie/'.$movieId.'/review');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\Post;
use App\Comment;
use App\Notifications\Liked;

class LikesController extends Controller
{
    public function add(Request $request)
    {
    	Like::create([
    		'user_id' => Auth::id(),
    		'post_id' => $request->post_id,
    		'comment_id' => $request->comment_id,
    	]);

        /**
         * If post liked
         */
        if(! is_null($request->post_id)) {

            $post = Post::findOrFail($request->post_id);

            if(Auth::id() != $post->user_id) {

                $content = [
                    'post' => $post,
                    'comment' => null,
                ];

                $post->user->notify(new Liked($content));
            }
        }

        /**
         * If comment liked
         */
        if(! is_null($request->comment_id)) {
            $comment = Comment::findOrFail($request->comment_id);

            if(Auth::id() != $comment->user_id) {
                $content = [
                    'post' => null,
                    'comment' => $comment,
                ];

                $comment->user->notify(new Liked($content));
            }
        }

    	return back();
    }

    public function delete(Request $request)
    {
        Like::where([
    		'user_id' => Auth::id(),
    		'post_id' => $request->post_id,
    		'comment_id' => $request->comment_id,
    	])->delete();

        return back();
    }
}

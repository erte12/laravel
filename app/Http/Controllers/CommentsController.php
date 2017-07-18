<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentsController extends Controller
{

    /**
     * Construct with middleware
     */
    public function __construct()
    {
        $this->middleware('comment_permission', ['only' => [
            'edit',
            'update',
            'destroy'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = 'comment_content_post_' . $request->post_id;

        $this->validate($request, [
            $content => 'required|min:5',
            ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaki',
        ]);


        $post = new Comment();
        $post->user_id = Auth::id();
        $post->post_id = $request->post_id;
        $post->content = $request->$content;
        $post->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_admin()) {
            $comment = Comment::withTrashed()->findOrFail($id);
        } else {
            $comment = Comment::findOrFail($id);
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comment_content' => 'required|min:5',
            ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaki',
            ]);

        if(is_admin()) {
            $post = Comment::withTrashed()
            ->find($id)
            ->update([
                'content' => $request->comment_content,
            ]);
        } else {
            $post = Comment::find($id)
            ->update([
                'content' => $request->comment_content,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        if(is_admin() && $comment->trashed()) {
            $comment->forceDelete();
        } else {
            $comment->delete();
        }

        return back();
    }
}

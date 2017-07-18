<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('post_permission', ['only' => [
            'edit',
            'update',
            'destroy'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_content' => 'required|min:5',
            ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaki',
            ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->post_content;
        $post->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
         if(is_admin()) {
             $post = Post::find($id)->withTrashed();
         } else {
             $post = Post::find($id);
         }

         return view('posts.show', compact('post'));
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
            $post = Post::withTrashed()->findOrFail($id);
        } else {
            $post = Post::findOrFail($id);
        }

        echo view('posts.edit', compact('post'));
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
            'post_content' => 'required|min:5',
            ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaki',
            ]);

        if(is_admin()) {
            $post = Post::withTrashed()
            ->find($id)
            ->update([
                'content' => $request->post_content,
            ]);
        } else {
            $post = Post::find($id)
            ->update([
                'content' => $request->post_content,
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
        $post = Post::withTrashed()->findOrFail($id);

        if(is_admin() && $post->trashed()) {
            $post->forceDelete();
            $post->comment()->forceDelete();
        } else {
            $post->delete();
            $post->comment()->delete();
        }

        return back();
    }
}

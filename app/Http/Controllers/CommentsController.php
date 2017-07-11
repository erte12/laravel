<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump('$request->comment_content_post_' . $request->post_id);
        // exit;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

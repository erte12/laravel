<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikesController extends Controller
{
    public function add(Request $request)
    {
    	Like::create([
    		'user_id' => Auth::id(),
    		'post_id' => $request->post_id,
    		'comment_id' => $request->comment_id,
    	]);

    	return back();
    }

    public function destroy($id)
    {

    }
}

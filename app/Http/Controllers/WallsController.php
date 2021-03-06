<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;

use Illuminate\Http\Request;

class WallsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$friends = Auth::user()->friends();

    	$friends_id_array = array();

    	$friends_id_array[] = Auth::id();
    	foreach ($friends as $friend) {
    		$friends_id_array[] = $friend->id;
    	}

		if(is_admin()) {
			$posts = Post::with('comment.user')
			->with('comment.likes')
            ->with('likes')
			->withTrashed()
			->whereIn('user_id', $friends_id_array)
			->orderBy('created_at', 'desc')
			->paginate(5);
		} else {
			$posts = Post::with('comment.user')
			->with('comment.likes')
            ->with('likes')
			->whereIn('user_id', $friends_id_array)
			->orderBy('created_at', 'desc')
			->paginate(5);
		}

    	return view('wall.index', compact('posts'));
    }
}

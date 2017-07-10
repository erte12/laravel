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

    	$posts = Post::whereIn('user_id', $friends_id_array)
    	->orderBy('created_at', 'desc')
    	->paginate(5);

    	return view('wall.index', compact('posts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;


class ImageController extends Controller
{
    public function user_avatar($id, $size)
    {
    	$user = User::findOrFail($id);

    	if(strpos($user->avatar, 'http') !== false) {
	 		$img = Image::make($user->avatar);
    	} elseif ($user->avatar == null) {
    		$img = Image::make(asset('storage/users/default_avatar.png'));
    	} else {
    		$avatar_url = url('storage/users/' . $user->id . '/avatars/' . $user->avatar);
	 		$img = Image::make($avatar_url);
    	}

    	return $img->fit($size)->response();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Friends;
use App\User;
use App\Notifications\FriendRequestSent;
use App\Notifications\FriendRequestAccepted;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $friends = User::find($user_id)->friends();

        return view('friends.index',compact('friends'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($friend_id)
    {

        if(!friendship(Auth::id(), $friend_id)->exists) {
            $friends = new Friends();
            $friends->user_id = Auth::id();
            $friends->friend_id = $friend_id;
            $friends->save();

            User::findOrFail($friend_id)->notify(new FriendRequestSent);

        } else {
            $this->accept($friend_id);
        }

        return back();
    }

    /**
     * Store a newly created$friend_id resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accept($friend_id)
    {
        $friends = Friends::where([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
            'accepted' => 0,
        ])->update([
            'accepted' => 1,
        ]);

        User::findOrFail($friend_id)->notify(new FriendRequestAccepted);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($friend_id)
    {
        $friends = Friends::where([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
            ])->orWhere([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id,
            ])->delete();

        return back();
    }
}

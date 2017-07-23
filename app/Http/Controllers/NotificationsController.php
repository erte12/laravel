<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // auth()->user()->notifications->markAsRead();
        return view('notifications.index');
    }

    public function update($id)
    {
        DatabaseNotification::where([
            'id' => $id,
            'notifiable_id' => auth()->id(),
        ])->first()->markAsRead();

        return back();
    }
}

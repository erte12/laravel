<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_permission', ['except' => [
            'show',
            ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
            'name' => 'required|min:3',
            'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($id),
            ],
            ], [
            'required' => 'Pole jest wymagane',
            'email' => 'Adres e-mail jest niepoprawny',
            'unique' => 'Adres e-mail istnieje już w bazie',
            'min' => 'Pole musi mieć minimum :min znaki',
            ]);

        $user = User::findOrFail($id);

        if($request->avatar) {
            $avatar_path = 'public/users/' . $id . '/avatars';
            $path = $request->file('avatar')->store($avatar_path);
            $avatar = str_replace('public/users/' . $id . '/avatars/', '', $path);
            $user->avatar = $avatar;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->save();

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
        //
    }
}

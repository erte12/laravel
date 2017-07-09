@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-1 col-md-3">
            @include('users.sidebar')
        </div>

        <div class="col-md-7">
            @if (Auth::id() == $user->id)
                @include('posts.add')
            @endif

            @foreach ($posts as $post)
                @include('posts.include.single')
            @endforeach


        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            @if (Auth::check())
                @include('posts.add')
            @endif

            @foreach ($posts as $post)
                @include('posts.include.single')
            @endforeach

            <div class="row text-center">
                <div class="col-md-12">
                    {{ $posts }}
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            @include('posts.include.single')
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @include('posts.include.single')
        </div>
    </div>
</div>
@endsection

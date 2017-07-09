@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                Znajomi
                <span class="label label-default">
                    {{ $friends->count() }}
                </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($friends as $friend)
                            <div class="col-md-4 center-block text-center">
                                <a href="{{ url('/users/' . $friend->id) }}">
                                    <div class="thumbnail">
                                        <img src="{{ asset('user-avatar/' . $friend->id . '/200') }}" class="img-responsive">
                                        <h4>{{ $friend->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="row text-center">
                        <div class="col-md-12">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

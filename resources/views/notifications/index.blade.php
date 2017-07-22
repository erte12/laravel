@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                Powiadomienia
                </div>
                <div class="panel-body">

                        @if(Auth::user()->unreadNotifications->count() === 0)
                            <h4 class="text-center">Brak powiedomień</h4>
                        @else
                            <ul class="list-group">
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <li class="list-group-item">
                                        {{ $notification->data['message'] }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

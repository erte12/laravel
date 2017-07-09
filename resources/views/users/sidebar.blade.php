<div class="panel panel-default">
    <div class="panel-heading">
    Użytkownik
    @if ($user->id == Auth::id())
        <a href="{{ url('/users/' . $user->id . '/edit') }}" class="pull-right"><small>Edytuj</small></a>
    @endif

    </div>
        <div class="panel-body text-center">
            <img src="{{ asset('user-avatar/' . $user->id . '/200') }}" class="img-thumbnail img-responsive center-block ">

            <h2><a href="{{ url('/users/' . $user->id) }}">{{ $user->name }}</a></h2>
            <p>
                @if ($user->sex == 'm')
                    Mężczyzna
                @else
                    Kobieta
                @endif
            </p>
            <p>
                {{ $user->email }}
            </p>
            <p>
                <a href="{{ url('/users/' . $user->id) . '/friends' }}">Znajomi</a>
                <span class="label label-default">
                    {{ $user->friends()->count() }}
                </span>
            </p>
            <p>


                    @if (Auth::check() && Auth::id() !== $user->id)
                        @if( !friendship(Auth::id(), $user->id)->exists )
                            <form method="POST" action="{{url('/friends/' . $user->id)}}">
                                {{ csrf_field() }}
                                <button class="btn btn-success">Zaproś do znajomych</button>
                            </form>
                        @else
                            @if( friendship(Auth::id(), $user->id)->accepted )
                                <form method="POST" action="{{url('/friends/' . $user->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger">Usuń ze znajomych</button>
                                </form>
                            @else
                                @if(is_sender(Auth::id(), $user->id))
                                    <button class="btn btn-success disabled">Wysłano zaproszenie</button>
                                @else
                                    <form method="POST" action="{{url('/friends/' . $user->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-primary">Zaakceptuj zaproszenie</button>
                                    </form>
                                @endif
                            @endif
                        @endif
                    @endif
            </p>
    </div>
</div>
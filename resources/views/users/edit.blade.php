@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja użytkownika</div>
                    <div class="panel-body">

                        @if ($user->avatar)
                            <img src="{{ asset('user-avatar/' . $user->id . '/200') }}" class="img-thumbnail img-responsive center-block" alt="Zdjęcie profilowe">
                        @endif

                        <form method="POST" class="form-horizontal" role="form" action=" {{ url('/users/' . $user->id )}} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                <label for="name" class="col-md-4 control-label">Imię i nazwisko</label>
                                    <div class="col-sm-6">
                                        <input id ="name" type="text" class="form-control" name="name" value="{{$errors->has('name') ? old('name') : $user->name}}" placeholder="Imię i nazwisko">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-4 control-label">E-Mail</label>
                                    <div class="col-sm-6">
                                        <input id ="email" type="text" class="form-control" name="email" value=" {{$errors->has('email') ? old('email') : $user->email}}" placeholder="E-Mail">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>

                            <div class="form-group">
                                <label for="sex" class="col-md-4 control-label">Płeć</label>

                                <div class="col-md-6">
                                    <select id="sex" type="text" class="form-control" name="sex">
                                        <option value="m" @if ($user->sex == 'm') selected @endif >Mężczyzna</option>
                                        <option value="f" @if ($user->sex == 'f') selected @endif>Kobieta</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-md-4 control-label">Avatar</label>
                                    <div class="col-sm-6">
                                        <input id ="avatar" type="file" class="form-control" name="avatar" placeholder="Wybierz avatar">

                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Zatwierdź</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

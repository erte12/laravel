@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja komentarza</div>
                <div class="panel-body">
                <form method="POST" role="form" action="{{ url('/comments/' . $comment->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group{{ $errors->has('comment_content') ? ' has-error' : '' }}">
                        @if ($errors->has('comment_content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment_content') }}</strong>
                            </span>
                        @endif
                        <textarea class="form-control" rows="2" name="comment_content"  placeholder="Komentarz" style="resize: none;">{{ $comment->content }}</textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Zapisz zmiany">
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
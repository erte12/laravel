@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja posta</div>
                <div class="panel-body">
                <form method="POST" role="form" action="{{ url('/posts/' . $post->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                        @if ($errors->has('post_content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('post_content') }}</strong>
                            </span>
                        @endif
                        <textarea class="form-control" rows="2" name="post_content"  placeholder="Co słychać?" style="resize: none;">{{ $post->content }}</textarea>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Zapisz zmiany">
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
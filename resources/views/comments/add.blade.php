<form method="POST" role="form" action="{{ url('/comments')}}">
    {{ csrf_field() }}


    <div class="pull-left">
        <img src="{{ asset('user-avatar/' . $post->user->id . '/40') }}" class="img-responsive">
    </div>

    <div class="col-xs-11">
        <div class="form-group{{ $errors->has('comment_content_post_' . $post->id) ? ' has-error' : '' }}">
            <input class="form-control" type="text" name="comment_content_post_{{ $post->id }}"  placeholder="Skomentuj" value="{{ old('comment_content') }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="submit" class="btn btn-default pull-right" value="Wyślij">
            @if ($errors->has('comment_content_post_' . $post->id))
                <span class="help-block">
                    <strong>{{ $errors->first('comment_content_post_' . $post->id) }}</strong>
                </span>
            @endif
        </div>
    </div>
</form>
<form method="POST" role="form" action="{{ url('/comments')}}">
    {{ csrf_field() }}


    <img src="{{ asset('user-avatar/' . $post->user->id . '/40') }}" class="img-responsive">
    <div class="form-group{{ $errors->has('comment_content_post_' . $post->id) ? ' has-error' : '' }}">
        <input class="form-control" type="text" name="comment_content_post_{{ $post->id }}"  placeholder="Skomentuj" value="{{ old('comment_content') }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
    </div>

    <div class="pull-right">
        <input type="submit" class="btn btn-sm" value="Wyślij">
    </div>

    @if ($errors->has('comment_content_post_' . $post->id))
        <span class="help-block">
            <strong>{{ $errors->first('comment_content_post_' . $post->id) }}</strong>
        </span>
    @endif

</form>

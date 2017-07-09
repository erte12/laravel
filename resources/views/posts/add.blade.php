<div class="panel panel-default">
    <div class="panel-heading">Dodaj post</div>
        <div class="panel-body">
                <form method="POST" role="form" action="{{ url('/posts')}}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                        @if ($errors->has('post_content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('post_content') }}</strong>
                            </span>
                        @endif
                        <textarea class="form-control" rows="2" name="post_content"  placeholder="Co słychać?" style="resize: none;">{{ old('post_content') }}</textarea>
                    </div>
                    <input type="submit" class="btn btn-default pull-right" value="Wyślij">
                </form>
        </div>
</div>
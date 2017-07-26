<div class="row{{ ($comment->trashed()) ? ' trashed' : '' }}">
    <div class="col-md-12">
    	<hr>

        @if ( belongs_to_user($comment->user->id || is_admin()) )
            @include('comments.include.dropdown_menu')
        @endif

	    <div class="pull-left">
	        <img src="{{ asset('user-avatar/' . $comment->user->id . '/40') }}" class="img-responsive">
	    </div>

	    <div id="comment_id{{ $comment->id }}" class="col-xs-11">
            <a href="{{ url('users/' . $comment->user->id) }}">{{ $comment->user->name }}</a>
            <a class="pull-right" href="#comment_id{{ $comment->id }}"><small>{{ $comment->created_at }}</small></a>
             <br />
			{{ $comment->content }}

            @include('comments.include.likes')
	    </div>
    </div>
</div>

@section('footer')
    <script>
    $(function(){

    });
    </script>
@endsection

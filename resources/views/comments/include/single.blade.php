<div class="row{{ ($comment->trashed()) ? ' trashed' : '' }}">
    <div class="col-md-12">
    	<hr>

        @if ( belongs_to_user($comment->user->id || is_admin()) )
            @include('comments.include.dropdown_menu')
        @endif

	    <div class="pull-left">
	        <img src="{{ asset('user-avatar/' . $comment->user->id . '/40') }}" class="img-responsive">
	    </div>

	    <div class="col-xs-11">
            <a href="{{ url('users/' . $comment->user->id) }}">{{ $comment->user->name }}</a> <br />
			{{ $comment->content }}

            @include('comments.include.likes')
	    </div>
    </div>
</div>

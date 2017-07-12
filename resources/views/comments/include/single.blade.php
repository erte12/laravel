<div class="row">
    <div class="col-md-12">
    	<hr>

        @if ($comment->user->id == Auth::id())
            @include('comments.include.dropdown_menu')
        @endif

	    <div class="pull-left">
	        <img src="{{ asset('user-avatar/' . $comment->user->id . '/40') }}" class="img-responsive">
	    </div>

	    <div class="col-xs-11">
			{{ $comment->content }}
	    </div>

    </div>
</div>



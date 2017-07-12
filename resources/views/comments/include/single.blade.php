<div class="row">
    <div class="col-md-12">

    	@if (! $loop->first)
    		<hr>
    	@endif

	    <div class="pull-left">
	        <img src="{{ asset('user-avatar/' . $comment->user->id . '/40') }}" class="img-responsive">
	    </div>

	    <div class="col-xs-11">
			{{ $comment->content }}
	    </div>

    </div>
</div>



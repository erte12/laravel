<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">

            <div class="col-md-12">
                <img src="{{ asset('user-avatar/' . $post->user->id . '/50') }}" class="img-responsive pull-left" style="margin-right: 6px; margin-bottom: 6px">
                <a class="pull-left" href="{{ url('/users/' . $post->user->id) }}"><strong>{{ $post->user->name }}</strong></a>

                @if ($post->user->id == Auth::id())
                    @include('posts.include.dropdown_menu')
                @endif

                <br>
                <a class="pull-left" href="{{ url('/posts/' . $post->id) }}"><small>{{ $post->created_at }}</small></a>
            </div>
        </div>

        <div id="post_{{ $post->id }}" class="row">
            <div class="col-md-12">
                {{ $post->content }}
            </div>
        </div>
        <hr>
            @if (Auth::check())
                @include ('comments.add')
            @endif
    </div>
</div>
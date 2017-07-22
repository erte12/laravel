@if (Auth::check())
    @if (! Auth::user()->likes->contains('post_id', $post->id) )
        <form action="{{ url('/likes/') }}" method="post" style="margin-top: 10px;">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Polub <span class="label label-info">{{ $post->likes->count() }}</span></button>
        </form>
    @else
        <form action="{{ url('/likes/') }}" method="post" style="margin-top: 10px;">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Odlub <span class="label label-info">{{ $post->likes->count() }}</span></button>
        </form>
    @endif
@endif

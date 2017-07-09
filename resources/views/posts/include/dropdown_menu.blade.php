<div class="dropdown pull-right">
    <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <span class="caret"></span>
    </span>
    <ul class="dropdown-menu">
        <li><a href="{{ url('posts/' . $post->id . '/edit') }}">Edytuj</a></li>
        <li>
            <form method="POST" action="{{ url('posts/' . $post->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit">Usuń</button>
            </form>
        </li>
    </ul>
</div>
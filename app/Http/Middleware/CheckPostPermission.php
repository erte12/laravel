<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Post;

class CheckPostPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post_exists = Post::where([
            'id' => $request->post,
            'user_id' => Auth::id(),
        ])->exists();

        if(! $post_exists) {
            abort(403, 'Brak dostępu');
        }

        return $next($request);
    }
}

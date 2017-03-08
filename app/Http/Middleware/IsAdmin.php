<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $user = Auth::user();
    if ($user && $user->isAdmin) {
      return $next($request);
    }
    return abort(404);
  }
}

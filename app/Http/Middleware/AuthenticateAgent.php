<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class AuthenticateAgent
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
        if (! Auth::guard('agent')->check()) {
         return redirect('/agent_login');
     }
     return $next($request);
 }
}

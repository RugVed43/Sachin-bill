<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class AuthenticateAdmin
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

        if (! Auth::guard('admin')->check()) {
           return redirect('/admin_login');
       }
    //  if (Auth::guard('admin')->user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
    //  {
    //     return $next($request);
    // }

    // if ($request->is('admin/madmin/create'))//If user is creating a post
    // {
    //     if (!Auth::guard('admin')->user()->hasPermissionTo('Create Admin'))
    //     {
    //         Session::flash('auth_error',"You do not have permission to access that page !");
            
    //         return redirect()->route('admin_home');
    //     } 
    //     else {
    //         return $next($request);
    //     }
    // }

// if ($request->is('posts/*/edit')) //If user is editing a post
// {
//     if (!Auth::guard('admin')->user()->hasPermissionTo('Edit Post')) {
//         abort('401');
//     } else {
//         return $next($request);
//     }
// }

// if ($request->isMethod('Delete')) //If user is deleting a post
// {
//     if (!Auth::guard('admin')->user()->hasPermissionTo('Delete Post')) {
//         abort('401');
//     } 
//     else 
//     {
//         return $next($request);
//     }
// }
    return $next($request);
}
}

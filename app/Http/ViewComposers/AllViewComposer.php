<?php
namespace App\Http\ViewComposers;

use App\Admin;
use App\User;
use Auth;
use Illuminate\Contracts\View\View;

class AllViewComposer
{

    public function compose(View $view)
    {
        $user = null;
        $users = User::all();
        $admins = Admin::all();
		//declareVar
        if (Auth::check()) {
            $user = Auth::user();

        }
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        }
        if (Auth::guard('agent')->check()) {
            $user = Auth::guard('agent')->user();
        }
        $with = array_merge([
            'me' => $user,
            'user' => $user,
            'admins' => $admins,
            'users' => $users,
			//respondVar
        ], $view->getData());

        $view->with($with);
    }
}

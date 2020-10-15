<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminAuthController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/admin_login';

	protected $username = 'username';

	protected function guard()
	{
		return Auth::guard('admin');
	}
	public function username()
	{
		return 'username';
	}
	public function showLoginForm()
	{
		return view('adminauth.login');
	}

}

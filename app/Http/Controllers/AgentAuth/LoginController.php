<?php

namespace App\Http\Controllers\AgentAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/agent_login';

	protected $username = 'username';

	protected function guard()
	{
		return Auth::guard('agent');
	}
	public function username()
	{
		return 'username';
	}
	public function showLoginForm()
	{
		return view('agentauth.login');
	}

}

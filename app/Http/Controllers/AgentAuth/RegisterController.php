<?php

namespace App\Http\Controllers\AgentAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Agent Model
use App\Agent;

//Auth Facade used in guard
use Auth;
class RegisterController extends Controller
{

	protected $redirectPath = 'agent_home';

      //shows registration form to agent
	public function showRegistrationForm()
	{
		return view('agent.auth.register');
	}

	public function register(Request $request)
	{

       //Validates data
		$this->validator($request->all())->validate();

       //Create agent
		$agent = $this->create($request->all());

        //Authenticates agent
		$this->guard()->login($agent);

       //Redirects agents
		return redirect($this->redirectPath);
	}

        //Validates user's Input
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:agents',
			'password' => 'required|min:6|confirmed',
			]);
	}


	protected function create(array $data)
	{
		return Agent::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			]);
	}

    //Get the guard to authenticate Seller
	protected function guard()
	{
		return Auth::guard('agent');
	}
}

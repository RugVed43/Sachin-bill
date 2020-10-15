<?php

namespace App\Http\Controllers\Api\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAgentAuthentication extends Controller
{
    use AuthenticatesUsers;

    protected $username = 'username';

    public function username()
    {
        return 'username';
    }
    public function guard()
    {
        return 'agent';
    }

    public function index()
    {

    }

    public function store(Request $request)
    {

        $input = $request->all();
        if (Auth::guard('agent')->attempt(['username' => $input['username'], 'password' => $input['password']], 1)) {
            $agent = Auth::guard('agent')->user();
            // $token = $agent->tokens()->where("created_at", "<=", now()->subMonth())->delete();
            $tokens = $agent->tokens()->where('name','AgentToken')->where("created_at", "<=", now()->subMonth());
            if (!empty($tokens->first())) {
                $tokens->each(function ($tk) {
                    $tk->delete();
                });
            }
            $success['token'] = $agent->createToken('AgentToken')->accessToken;
            $success['name'] = $agent->name;
            return response()->json(['success' => true, 'user' => $agent, 'token' => $success['token']]);
        } else {
            return response()->json(['success' => false]);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
    public function logout(Request $request)
    {
        if (Auth::guard('agent')->user()) {
            $agent = Auth::user();
            $agent->tokens()->delete();
        }
        return response()->json(['success' => true]);

    }
}

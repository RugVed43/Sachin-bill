<?php

namespace App\Http\Controllers\Api\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAdminAuthentication extends Controller
{
    use AuthenticatesUsers;

    protected $username = 'username';

    public function username()
    {
        return 'username';
    }
    public function guard()
    {
        return 'admin';
    }

    public function index()
    {

    }

    public function store(Request $request)
    {

        $input = $request->all();
        if (Auth::guard('admin')->attempt(['username' => $input['username'], 'password' => $input['password']], 1)) {
            $admin = Auth::guard('admin')->user();
            // $token = $admin->tokens()->where("created_at", "<=", now()->subMonth())->delete();
            $tokens = $admin->tokens()->where('name','AdminToken')->where("created_at", "<=", now()->subMonth());
            if (!empty($tokens->first())) {
                $tokens->each(function ($tk) {
                    $tk->delete();
                });
            }
            $success['token'] = $admin->createToken('AdminToken')->accessToken;
            $success['name'] = $admin->name;
            return response()->json(['success' => true, 'user' => $admin, 'token' => $success['token']]);
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
        if (Auth::guard('admin')->user()) {
            $admin = Auth::user();
            $admin->tokens()->delete();
        }
        return response()->json(['success' => true]);

    }
}

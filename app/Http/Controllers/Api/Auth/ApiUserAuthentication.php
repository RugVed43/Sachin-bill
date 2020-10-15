<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ApiUserAuthentication extends Controller
{
    use AuthenticatesUsers;

    protected $username = 'username';

    public function username()
    {
        return 'username';
    }

    public function index()
    {
        $user = Auth::guard('api')->user();
        return response()->json(['success' => true, 'user' => $user]);

    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $input = $request->all();
        if (isset($input['username']) && isset($input['password']) && !isset($input['forgot'])) {
            if (empty($input['username']) && empty($input['password'])) {
                return response()->json(['success' => false, 'input' => $input, 'msg' => 'Mobile Number & Password Not Provided']);
            }
        } else {
            if (!isset($input['forgot'])) {
                return response()->json(['success' => false, 'input' => $input, 'msg' => 'Mobile Number & Password Not Provided']);
            }
        }

        if (isset($input['register'])) {
            if (isset($input['username']) && isset($input['password'])) {
                if (!empty($input['username']) && !empty($input['password'])) {
                    $user = User::where(['username' => $input['username']])->first();
                    if (!empty($user)) {
                        if (Auth::attempt(['username' => $input['username'], 'password' => $input['password']], 1)) {
                            $user = Auth::user();
                            // dd($user->tokens()->first());
                            // $token = $user->tokens()->where("expires_at", ">=", now())->get()->first();
                            $tokens = $user->tokens()->where('name', 'UserToken')->where("created_at", "<=", now()->subMonth());
                            if (!empty($tokens->first())) {
                                $tokens->each(function ($tk) {
                                    $tk->delete();
                                });
                            }

                            $success['token'] = $user->createToken('UserToken')->accessToken;
                            $success['name'] = $user->name;
                            return response()->json(['success' => true, 'user' => $user, 'token' => $success['token']]);
                        } else {
                            return response()->json(['success' => false, 'msg' => 'INVALID MOBILE NUMBER: Please Provide a Different Mobile number']);
                        }

                    } else {
                        $user = User::create($input);
                        Auth::login($user, true);
                        $tokens = $user->tokens()->where('name', 'UserToken')->where("created_at", "<=", now()->subMonth());
                        if (!empty($tokens->first())) {
                            $tokens->each(function ($tk) {
                                $tk->delete();
                            });
                        }

                        $success['token'] = $user->createToken('UserToken')->accessToken;
                        $success['name'] = $user->name;
                        return response()->json(['success' => true, 'user' => $user, 'token' => $success['token']]);

                    }
                } else {
                    return response()->json(['success' => false, 'msg' => 'Mobile Number & Password Not Provided']);
                }
            } else {
                return response()->json(['success' => false, 'msg' => 'Mobile Number & Password Not Provided']);
            }

        }
        if (isset($input['forgot'])) {
            $user = User::where(['username' => $input['username']])->first();
            if (!empty($user)) {
                $password = rand(100000, 999999);
                $user->fill(['password' => $password])->save();
                return response()->json(['success' => true, 'msg' => 'Password has been reset and sent to your phone', 'password' => $password]);

            } else {
                return response()->json(['success' => false, 'msg' => 'Mobile Number & Password Not Provided']);
            }

        }

        if (Auth::attempt(['username' => $input['username'], 'password' => $input['password']], 1)) {
            $user = Auth::user();
            // dd($user->tokens()->first());
            // $token = $user->tokens()->where("expires_at", ">=", now())->get()->first();
            $tokens = $user->tokens()->where('name', 'UserToken')->where("created_at", "<=", now()->subMonth());
            if (!empty($tokens->first())) {
                $tokens->each(function ($tk) {
                    $tk->delete();
                });
            }

            $success['token'] = $user->createToken('UserToken')->accessToken;
            $success['name'] = $user->name;
            return response()->json(['success' => true, 'user' => $user, 'token' => $success['token']]);
        } else {
            return response()->json(['success' => false, 'msg' => 'Invalid Login Credentials']);
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
        if (Auth::user()) {
            $user = Auth::user();
            $user->tokens()->delete();
        }
        return response()->json(['success' => true]);

    }
}

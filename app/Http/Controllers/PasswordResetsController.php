<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\Admin;
use App\User;
use App\Agent;
use Auth;
use Mail;
use Carbon\Carbon;
class PasswordResetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.passwords.email');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (isset($input['respasstoken'])) {
            $respass =  PasswordReset::where(['token' => $input['respasstoken']])->first();
            $entity = $respass->resetable;
            if ($input['password'] == $input['confirm_password']) {
                $entity->password = $input['password'];
                $entity->save();
                return redirect()->route('login');
            } else {
                return redirect()->back()->withInput();
            }

            return false; 
        }
        $user = $admin = $agent = NULL;

        if ($input['type'] == "USER") {
            if (strpos($input['username'], "@") > -1) {
                $user =  User::where(['email' => $input['email']])->first();
            } else {
                $user =  User::where(['username' => $input['username']])->first();
            }
            if (empty($user)) {
                return redirect()->route('login', [
                    'message' => "User Not Found"
                    ]); 
            }
            $respas = PasswordReset::create([
                'resetable_type' => "App\User",  
                'resetable_id' => $user->id,  
                'token' => md5($user->password).time(),
                'email' => $user->email,
                ]);

            Mail::send('auth.passwords.email', ['user' => $user,'respas' => $respas,], function ($message) use ($user) {
                $message->from(getenv("ADMIN_MAIL"), getenv("ADMIN_NAME"));
                $message->sender(getenv("ADMIN_MAIL"), getenv("ADMIN_NAME"));
                $message->to($user->email, $user->fname);
                $message->subject('Link to Reset Your Login Credentials');
            });
        }
        if ($input['type'] == "ADMIN") {
            if (strpos($input['username'], "@") > -1) {
                $admin =  Admin::where(['email' => $input['email']])->first();
            } else {
                $admin =  Admin::where(['username' => $input['username']])->first();
            }
        }
        if ($input['type'] == "AGENT") {
            if (strpos($input['username'], "@") > -1) {
                $agent =  Agent::where(['email' => $input['email']])->first();
            } else {
                $agent =  Agent::where(['username' => $input['username']])->first();
            }
        }
// date_add(date("d-m-Y H:i a",time()),"2 hours")
        dd($input,substr($user->password, 0,10).time(),Carbon::parse("@".time())->addHours(2)->format('d-m-Y H:i a'),Carbon::parse("@".time())->addHours(2)->gt(Carbon::now())); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('auth.passwords.reset_request') ->with([ 
           'type' => $id, 
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $respass =  PasswordReset::where(['token' => $id])->first();
        $entity = $respass->resetable; 

        return view('auth.passwords.reset_pass')->with([ 
           'entity' => $entity, 
           'respass' => $respass, 
           ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request,$id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

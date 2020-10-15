<?php

namespace App\Http\Controllers\User;

use App\User;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            "landing",
            "laraLogView",
            "laraLogClear",
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function profile()
    {
        return view('profile');
    }
    public function setProfile(Request $request)
    {
        $input = $request->all();
        if (!isset($input['password'])) {
            unset($input['password']);
        }
        unset($input['confirm_password']);
        $admin = User::find($input['id']);
        $admin->fill($input)->save();
        return redirect()->back()->withInput();
    }
    public function pay()
    {
        $parameters = [
            'key' => '1PPFcxUH',
            'tid' => '1233221223322',
            'txnid' => '1233221223322',
            'surl' => route('recv'), // this is the name of my route
            'furl' => route('recv'), //this is the name of my route
            'firstname' => 'Antonius Carvalho',
            'email' => 'info@ianto.in',
            'phone' => '9773991234',
            'productinfo' => 'foodhomey',
            'service_provider' => 'payu_paisa',
            'amount' => '1',

        ];
        $order = Indipay::gateway('PayUMoney')->prepare($parameters);

        return Indipay::process($order);
    }
    public function recv(Request $request)
    {
        $response = Indipay::response($request);
        dd($response['status'], $response['amount']);
    }
    public function landing()
    {
        return view('auth.login');
    }
    public function laraLogView()
    {
        return "<pre>" . File::get(storage_path('logs/laravel.log'));

    }
    public function laraLogClear()
    {
        exec('echo "" > ' . storage_path('logs/laravel.log'));

        return response()->json([
            'success' => true,
            'messge' => 'Log File Cleared',
        ]);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
    public function profile()
    {
        return view('admin.profile');
    }
    public function setProfile(Request $request)
    {
        $input = $request->all();
        if (isset($input['password'])) {
            if (empty($input['password'])) {
                unset($input['password']);
            }
        }

        unset($input['confirm_password']);
        $admin = Admin::find($input['id']);
        $admin->fill($input)->save();
        return redirect()->back()->withInput();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManageAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins')->with([
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::all();
        return view('admin.admin')->with([
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $admin = Admin::create($input);
        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $admin->assignRole($role_r); //Assigning role to user
            }
        }
        $permissions = $request['permissions'];
        if (isset($permissions)) {
            foreach ($permissions as $permission) {
                $permission_p = Permission::where('id', '=', $permission)->firstOrFail();
                $admin->givePermissionTo($permission_p); //Assigning role to user
            }
        }
        return redirect()->route('madmin.index');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::get(); //Get all roles
        $permissions = Permission::all();
        return view('admin.admin')->with([
            'permissions' => $permissions,
            'admin' => $admin,
            'roles' => $roles,
            'edit' => 'edit',
        ]);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $input = $request->all();
        if (isset($input['password'])) {
            if (empty($input['password'])) {
                unset($input['password']);
            }
        }

        $admin->fill($input)->save();
        $roles = $request['roles']; //Retreive all roles
        $permissions = $request['permissions']; //Retreive all roles
        if (isset($roles)) {
            $admin->roles()->sync($roles); //If one or more role is selected associate user to roles
        } else {
            $admin->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        if (isset($permissions)) {
            $admin->permissions()->sync($permissions); //If one or more role is selected associate user to roles
        } else {
            $admin->permissions()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        ActionLog::create([
            'by' => Auth::guard('admin')->user()->username,
            'action' => 'Deleted a Admin & roles / privilages',
            'admin_id' => Auth::guard('admin')->user()->id,
            'user_id' => null,
            'distributor_id' => null,
            'tbl' => "admin",
            'tid' => $admin->id,
        ]);
        return redirect()->route('madmin.index');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

use Session;
class ManageRoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles')->with([
            'roles' => $roles,
            ]);
    }
    
    public function create()
    {
             $permissions = Permission::all();//Get all permissions
             return view('admin.role')->with([ 
                'permissions' => $permissions, 
                ]);
         }

         public function store(Request $request)
         {

            $input = $request->except('permissions');
            $input['guard_name'] = 'admin';
            $role = Role::create($input);
            $permissions = $request['permissions'];
            //Looping thru selected permissions
            if (!empty($permissions)) {
                foreach ($permissions as $permission) {
                    $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Fetch the newly created role and assign permission
                    $role = Role::where('name', '=', $input['name'])->first(); 
                    $role->givePermissionTo($p);
                }
            }
            return redirect()->route('mroles.index');

        }

        public function show($id)
        {
            //
        }

        public function edit($id)
        {
            $role = Role::find($id);
            $permissions = Permission::all();
            return view('admin.role')->with([
                'role' => $role,
                'permissions' => $permissions, 
                'edit' => 'edit',
                ]);
        }

        public function update(Request $request, $id)
        {
            $role = Role::find($id);
            $input = $request->except('permissions');
            $input['guard_name'] = 'admin';
            $role->fill($input)->save();
            $permissions = $request['permissions'];
             $p_all = Permission::all();//Get all permissions
             foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }
    }

    return redirect()->back();
}

public function destroy($id)
{
 $role = Role::find($id);
 $role->delete();
 return redirect()->route('mroles.index');
}

}

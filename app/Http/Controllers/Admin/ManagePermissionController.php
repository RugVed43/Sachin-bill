<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;
use App\Http\Controllers\Controller;

class ManagePermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions')->with([
            'permissions' => $permissions,
            ]);
    }
    
    public function create()
    {
      $roles = Role::get();
      return view('admin.permission')->with([ 
        'roles' => $roles, 
        ]);
  }

  public function store(Request $request)
  {

    $input = $request->except('roles');
    $input['guard_name'] = 'admin';
    $permission = Permission::create($input);
    $roles = $request['roles'];
              if (!empty($request['roles'])) { //If one or more role is selected
                foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $input['name'])->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }
        return redirect()->route('mpermissions.index');

    }
    
    public function show($id)
    {
        return redirect('permissions');
    }
    
    public function edit($id)
    {
        $permission = Permission::find($id);
        $roles =  Role::all();
        return view('admin.permission')->with([
            'permission' => $permission,
            'roles' => $roles,
            'edit' => 'edit',
            ]);
    }
    
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $input = $request->except('roles');
        $input['guard_name'] = 'admin';
        $permission->fill($input)->save();
        $roles = $request['roles'];
              if (!empty($request['roles'])) { //If one or more role is selected
                foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $input['name'])->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }
        return redirect()->back();
    }
    
    public function destroy($id)
    {
       $permission = Permission::find($id);
       if ($permission->name == "Administer roles & permissions") {
        return redirect()->route('mpermissions.index')
        ->with('flash_message',
         'Cannot delete this Permission!');
    }
    $permission->delete();
    return redirect()->route('mpermissions.index');
}

}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use DataTables;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return response()->json(['success' => true, 'admins' => $admins]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $admin = Admin::create($input);
        return response()->json(['success' => true, 'admin' => $admin]);
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return response()->json(['success' => true, 'admin' => $admin]);
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return response()->json(['success' => true, 'admin' => $admin]);
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
        return response()->json(['success' => true, 'admin' => $admin]);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }

    public function getDataTables()
    {
        $admins = Admin::all();
        // Log::debug("test");
        return DataTables::of($admins)->toJson();
    }
    public function postDataTables(Request $request)
    {
        return DataTables::of(Admin::query())->toJson();
    }
}

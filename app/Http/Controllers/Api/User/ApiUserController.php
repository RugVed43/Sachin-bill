<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['success' => true, 'users' => $users]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = User::create($input);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        if (isset($input['password'])) {
            if (empty($input['password'])) {
                unset($input['password']);
            }
        }

        $user->fill($input)->save();
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }

    public function getDataTables()
    {
        $users = User::all();
        // Log::debug("test");
        return DataTables::of($users)->toJson();
    }
    public function postDataTables(Request $request)
    {
        return DataTables::of(User::query())->toJson();
    }
}

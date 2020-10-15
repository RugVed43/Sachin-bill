<?php

namespace App\Http\Controllers;

use Request;

class FileManagerController extends Controller
{

    public function index()
    {
        return response()->json(["success" => true]);
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(Request $request)
    {
        $input = Request::all();
        $output = [];
        $model = "";
        if (!empty(Request::header('model')) && !empty(Request::header('mid'))) {
            $model = "App\\" . Request::header('model');
            $instance = $model::find(Request::header('mid'));
            $path = "storage/" . Request::file(key($input))->store(Request::header('folder'), 'storage');
            $instance->{key($input)} = $path;
            $instance->save();
            return response()->json([$input, $instance, $path]);
            return $path;
        } else {
            if (Request::hasFile(key($input))) {
                return response()->json("storage/" . Request::file(key($input))->store(Request::header('folder'), 'storage'));
            }
        }

        return response()->json();
    }

    public function show($id)
    {
        return response()->json([$id]);
    }

    public function edit($id)
    {
        return response()->json([$id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        return response()->json(['input' => $input]);
    }

    public function destroy($id)
    {
        return response()->json(['success' => 'success']);
    }

}

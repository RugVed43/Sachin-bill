<?php

namespace App\Http\Controllers\Api\Agent;

use App\Agent;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;

class ApiAgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all();
        return response()->json(['success' => true, 'agents' => $agents]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $agent = Agent::create($input);
        return response()->json(['success' => true, 'agent' => $agent]);

    }

    public function show($id)
    {
        $agent = Agent::find($id);
        return response()->json(['success' => true, 'agent' => $agent]);
    }

    public function edit($id)
    {
        $agent = Agent::find($id);
        return response()->json(['success' => true, 'agent' => $agent]);
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::find($id);
        $input = $request->all();
        $agent->fill($input)->save();
        return response()->json(['success' => true, 'agent' => $agent]);
    }

    public function destroy($id)
    {
        $agent = Agent::find($id);
        $agent->delete();
        return response()->json(['success' => true, 'message' => 'Deleted']);
    }
    public function getDataTables()
    {
        $agent = Agent::all();
        return DataTables::of($agent)->toJson();
    }
    public function postDataTables(Request $request)
    {
        return DataTables::of(Agent::query())->toJson();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Agent;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageAgentController extends Controller
{

    public function index()
    {
        $agents = Agent::all();
        return view('admin.agents')->with([
            'agents' => $agents,
            ]);
    }

    public function create()
    {
       return view('admin.agent');
   }

    public function store(Request $request)
    {

        $input = $request->all();
        $agent = Agent::create($input);
        return redirect()->route('magent.index');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $agent = Agent::find($id);
        return view('admin.agent')->with([
            'agent' => $agent,
            'edit' => 'edit',
            ]);
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::find($id);
        $input = $request->all();
        if (isset($input['password'])) {
            if (empty($input['password'])) {
                unset($input['password']);
            } 
        }
        $agent->fill($input)->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
       $agent = Agent::find($id);
       $agent->delete();
       return redirect()->route('magent.index');
   }

}

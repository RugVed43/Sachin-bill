<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    public function index()
    {
        return view('agent.home');
    }

}

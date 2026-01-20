<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = \App\Models\Project::with('client')->get();
        return view('projects', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
        ]);

        \App\Models\Project::create($request->all());

        return back()->with('success', 'Project created successfully.');
    }
}

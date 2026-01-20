<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = \App\Models\Client::with('projects', 'invoices')->get();
        return view('clients', compact('clients'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalClients' => \App\Models\Client::count(),
            'activeProjects' => \App\Models\Project::where('status', 'Active')->count(),
            'paidInvoices' => \App\Models\Invoice::where('status', 'Paid')->sum('total'),
            'pendingAmount' => \App\Models\Invoice::where('status', 'Unpaid')->sum('total'),
        ];

        return view('dashboard', compact('stats'));
    }
}

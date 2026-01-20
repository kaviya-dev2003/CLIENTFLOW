@extends('layouts.app')

@section('title', 'Dashboard | CLIENTFLOW')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 mb-1">Welcome back, {{ auth()->user()->name }}</h1>
            <p class="text-muted small mb-0">Here's a summary of your workspace.</p>
        </div>
        <div class="user-profile d-flex align-items-center gap-3">
            <div class="text-end d-none d-md-block">
                <div class="small fw-semibold">{{ auth()->user()->name }}</div>
                <div class="text-muted" style="font-size: 11px;">{{ auth()->user()->getRoleNames()->first() }}</div>
            </div>
            <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
        </div>
    </header>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="stats-icon"><i class="bi bi-people"></i></div>
                <span class="stats-label">Total Clients</span>
                <h3 class="stats-value">{{ $stats['totalClients'] }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="stats-icon"><i class="bi bi-briefcase"></i></div>
                <span class="stats-label">Active Projects</span>
                <h3 class="stats-value">{{ $stats['activeProjects'] }}</h3>
            </div>
        </div>
        @can('view finance')
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="stats-icon"><i class="bi bi-cash-stack"></i></div>
                <span class="stats-label">Paid Revenue</span>
                <h3 class="stats-value">${{ number_format($stats['paidInvoices'], 0) }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="stats-icon"><i class="bi bi-clock-history"></i></div>
                <span class="stats-label">Pending</span>
                <h3 class="stats-value">${{ number_format($stats['pendingAmount'], 0) }}</h3>
            </div>
        </div>
        @endcan
    </div>

    <div class="card p-5 text-center border-dashed" style="background: rgba(255,255,255,0.01); border: 2px dashed rgba(255,255,255,0.1);">
        <i class="bi bi-activity fs-1 opacity-25 mb-3"></i>
        <h4 class="h5 text-muted">Activity Feed & Analytics coming soon</h4>
    </div>
@endsection

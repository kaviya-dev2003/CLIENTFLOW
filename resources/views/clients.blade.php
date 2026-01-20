@extends('layouts.app')

@section('title', 'Clients & Finance | CLIENTFLOW')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 mb-1">Clients & Finance</h1>
            <p class="text-muted small mb-0">Overview of client relationships and billing status.</p>
        </div>
        @can('create client')
        <button class="btn-primary">
            <i class="bi bi-person-plus me-2"></i> Add Client
        </button>
        @endcan
    </header>

    <div class="row g-4">
        @forelse($clients as $client)
        @php
            $billed = $client->invoices->sum('total');
            $paid = $client->projects->sum('budget'); // Mocking paid as budget for now if no payments table joined
            // Actually let's use the billed logic correctly
            $paid = $client->invoices->where('status', 'Paid')->sum('total');
            $due = $billed - $paid;
            $percent = $billed > 0 ? ($paid / $billed) * 100 : 0;
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="h5 mb-1">{{ $client->name }}</h4>
                        <p class="text-muted smaller mb-0">{{ $client->company }}</p>
                    </div>
                    <span class="badge {{ strtolower($client->status) == 'active' ? 'badge-active' : 'badge-pending' }}">{{ $client->status }}</span>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Total Billed</span>
                    <span class="fw-bold small">${{ number_format($billed, 0) }}</span>
                </div>
                
                <div class="progress mb-3" style="height: 6px; background: rgba(255,255,255,0.05);">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percent }}%;"></div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="text-muted smaller">Paid</div>
                        <div class="text-success fw-bold small">${{ number_format($paid, 0) }}</div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-muted smaller">Due</div>
                        <div class="text-danger fw-bold small">${{ number_format($due, 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">No clients recorded.</div>
        @endforelse
    </div>
@endsection

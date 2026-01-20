@extends('layouts.app')

@section('title', 'Login | CLIENTFLOW')

@section('styles')
    <style>
        .auth-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: var(--space-md); }
        .auth-card { width: 100%; max-width: 440px; background-color: var(--bg-surface); border-radius: 20px; padding: var(--space-xl); border: 1px solid rgba(255, 255, 255, 0.05); }
        .auth-logo { font-size: 28px; font-weight: 800; color: var(--primary); text-align: center; margin-bottom: var(--space-lg); }
    </style>
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">CLIENTFLOW</div>
            <h1 class="h4 text-center mb-1">Welcome back</h1>
            <p class="text-muted text-center small mb-4">Login to your account to continue</p>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@clientflow.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary w-100">Sign In</button>
            </form>
            
            <p class="text-center mt-4 text-muted small">
                Default password is <strong>password</strong>
            </p>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Welcome | CLIENTFLOW')

@section('styles')
    <style>
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0B0F19 0%, #111827 100%);
            padding: var(--space-xl) 0;
            position: relative;
            overflow: hidden;
        }
        .hero-title { font-size: 64px; font-weight: 800; background: linear-gradient(to right, #fff, #9CA3AF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-subtext { font-size: 20px; color: var(--text-muted); margin-bottom: var(--space-lg); }
        .navbar { position: absolute; top: 0; width: 100%; z-index: 10; padding: var(--space-md) 0; }
        .nav-brand { font-size: 24px; font-weight: 700; color: var(--primary) !important; }
        .feature-icon { font-size: 32px; color: var(--primary); margin-bottom: var(--space-sm); }
    </style>
@endsection

@section('content')
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand nav-brand" href="/">CLIENTFLOW</a>
            <div class="ms-auto d-none d-md-flex align-items-center">
                <a class="nav-link text-muted mx-3" href="#">Features</a>
                <a class="nav-link text-muted mx-3" href="{{ route('login') }}">Login</a>
                <a class="btn-primary ms-3" href="#" style="height: 40px; padding: 0 20px;">Get Started</a>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="hero-title">Manage Clients.<br>Track Projects.<br>Get Paid.</h1>
                        <p class="hero-subtext">Designed for freelancers and small agencies who value clarity and efficiency.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('login') }}" class="btn-primary">Start Free Trial</a>
                            <a href="#" class="btn-secondary">Request Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

<style>
    .prem-breadcrumb {
        padding: 100px 0 80px;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
        border-bottom: none !important;
    }

    .prem-breadcrumb::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.95));
        z-index: -1;
    }

    .prem-breadcrumb-title {
        font-size: 3rem;
        font-weight: 800;
        color: #ffffff;
        margin-top: 10px;
        letter-spacing: -0.5px;
    }

    .prem-breadcrumb-list {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .prem-breadcrumb-list a {
        color: #38bdf8;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .prem-breadcrumb-list a:hover {
        color: #ec4899;
    }

    .prem-breadcrumb-list span {
        color: #94a3b8;
    }

    .login-container {
        padding: 100px 0;
        background-color: #f8fafc;
    }

    .login-card {
        border-radius: 24px !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
        border: 1px solid #f1f5f9 !important;
        overflow: hidden;
    }

    .login-card-header {
        padding: 40px 40px 20px 40px !important;
    }

    .login-card-body {
        padding: 0 40px 40px 40px !important;
    }

    .prem-input {
        background: #f8fafc !important;
        border: 2px solid #e2e8f0 !important;
        padding: 14px 20px !important;
        border-radius: 12px !important;
        transition: all 0.3s ease !important;
    }

    .prem-input:focus {
        border-color: #3b82f6 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }

    .prem-btn-submit {
        background: #0f172a !important;
        border-radius: 12px !important;
        padding: 14px !important;
        font-size: 1.05rem !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }

    .prem-btn-submit:hover {
        background: #3b82f6 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(59, 130, 246, 0.3);
    }
</style>

@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background: url('{{ asset(config('settings.breadcrumb')) }}') center center/cover no-repeat;">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li class="breadcrumb-item font-14">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item font-14">
                            <span class="font-10"><i class="fas fa-chevron-right"></i></span>
                        </li>
                        <li class="breadcrumb-item font-14 active">
                            <span class="text-white opacity-50">Register</span>
                        </li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Create Account') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">

                    <div class="card login-card">
                        <div class="card-header login-card-header border-0 bg-white text-center">
                            <h4 class="fw-bold text-dark mb-1">{{ __('Create Account') }}</h4>
                            <p class="text-muted small mb-0">{{ __('Join us today and start your journey') }}</p>
                        </div>

                        <div class="card-body login-card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold small text-secondary">
                                                <i class="fas fa-user me-1 text-primary"></i>{{ __('Full Name') }}
                                            </label>
                                            <x-text-input id="name" class="form-control prem-input" type="text"
                                                name="name" :value="old('name')" required autofocus autocomplete="name"
                                                placeholder="Enter your full name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold small text-secondary">
                                                <i class="fas fa-envelope me-1 text-primary"></i>{{ __('Email Address') }}
                                            </label>
                                            <x-text-input id="email" class="form-control prem-input" type="email"
                                                name="email" :value="old('email')" required autocomplete="username"
                                                placeholder="example@mail.com" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold small text-secondary">
                                                <i class="fas fa-lock me-1 text-primary"></i>{{ __('Password') }}
                                            </label>
                                            <x-text-input id="password" class="form-control prem-input" type="password"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Create a strong password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-bold small text-secondary">
                                                <i
                                                    class="fas fa-shield-alt me-1 text-primary"></i>{{ __('Confirm Password') }}
                                            </label>
                                            <x-text-input id="password_confirmation" class="form-control prem-input"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Repeat your password" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary w-100 prem-btn-submit">
                                            {{ __('Register Now') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-4 pt-0 text-center">
                            <p class="mb-0 text-muted small">
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">
                                    {{ __('Sign In') }}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.master')

@section('content')
    <section class="breadcrumb-area py-5" style="background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-primary">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Forgot Password') }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold">{{ __('Reset Your Password') }}</h2>
        </div>
    </section>

    <section class="wsus__login padding-y-120 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7">

                    <!-- حالة الجلسة (Success Message) -->
                    <x-auth-session-status class="mb-4 shadow-sm border-0 alert alert-success" :status="session('status')" />

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 pt-5 px-5 text-center">
                            <h3 class="fw-bold text-dark mb-2">{{ __('Forgot Password?') }}</h3>
                            <p class="text-muted small">
                                {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
                            </p>
                        </div>

                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row g-4">

                                    <!-- Email Address -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-envelope me-2 text-primary"></i>{{ __('Email Address') }}
                                            </label>
                                            <x-text-input id="email" class="form-control py-3 shadow-none" type="email" name="email"
                                                :value="old('email')" required autofocus
                                                placeholder="Enter your registered email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm fw-bold">
                                            <i class="fas fa-paper-plane me-2"></i>{{ __('Send Reset Link') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-5 text-center">
                            <p class="mb-0 text-muted">
                                {{ __('Remembered your password?') }}
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">
                                    {{ __('Back to Login') }}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


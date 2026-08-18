@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <section class="prem-breadcrumb" style="background: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                        <li class="breadcrumb-item font-14"><a href="{{ url('/') }}"
                                class="text-white opacity-75 text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item font-14 text-white">Sign In</li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Sign In') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">

                    <div class="card login-card">
                        <div class="card-header login-card-header border-0 bg-white text-center">
                            <h4 class="fw-800 text-dark mb-1">{{ __('Sign In') }}</h4>
                            <p class="text-muted small">{{ __('Enter your details to access your account') }}</p>
                        </div>

                        <div class="card-body login-card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-secondary">
                                            <i class="fas fa-envelope me-1 text-primary"></i>{{ __('Email Address') }}
                                        </label>
                                        <x-text-input id="email" class="form-control prem-input" type="email"
                                            name="email" :value="old('email')" required autofocus
                                            placeholder="example@mail.com" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-1 small" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-secondary">
                                            <i class="fas fa-lock me-1 text-primary"></i>{{ __('Password') }}
                                        </label>
                                        <x-text-input id="password" class="form-control prem-input" type="password"
                                            name="password" required placeholder="••••••••" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-1 small" />
                                    </div>

                                    <div class="col-12 d-flex justify-content-between align-items-center my-2">
                                        <div class="form-check">
                                            <input class="form-check-input" name="remember" type="checkbox"
                                                id="remember_me">
                                            <label class="form-check-label text-muted small" for="remember_me">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="small text-primary fw-bold text-decoration-none">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 prem-btn-submit">
                                            {{ __('Sign In') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-4 pt-0 text-center">
                            <p class="mb-0 text-muted small">
                                {{ __("Don't have an account?") }}
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none ms-1">
                                    {{ __('Sign Up') }}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.master')

@section('content')
    <section class="breadcrumb-area py-5" style="background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-primary">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                </ol>
            </nav>
            <h2 class="fw-bold">{{ __('Welcome Back') }}</h2>
        </div>
    </section>

    <section class="wsus__login padding-y-120 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 pt-5 px-5 text-center">
                            <h3 class="fw-bold text-dark mb-2">{{ __('Sign In') }}</h3>
                            <p class="text-muted">{{ __('Please enter your details to access your account') }}</p>
                        </div>

                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row g-4">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-envelope me-2 text-primary"></i>{{ __('Email Address') }}
                                            </label>
                                            <x-text-input id="email" class="form-control py-3 shadow-none" type="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="username"
                                                placeholder="example@mail.com" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-lock me-2 text-primary"></i>{{ __('Password') }}
                                            </label>
                                            <x-text-input id="password" class="form-control py-3 shadow-none" type="password"
                                                name="password" required autocomplete="current-password"
                                                placeholder="••••••••" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" name="remember" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label text-muted small" for="flexCheckDefault">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none hover-underline">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm fw-bold">
                                            {{ __('Sign In') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-5 text-center">
                            <p class="create_account mb-0 text-muted">
                                {{ __("Don't have an account?") }}
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none ms-1 italic">
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


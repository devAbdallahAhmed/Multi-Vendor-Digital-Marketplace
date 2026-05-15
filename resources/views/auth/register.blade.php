@extends('frontend.layouts.master')

@section('content')
    <section class="breadcrumb-area py-5" style="background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-primary">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Account</li>
                </ol>
            </nav>
            <h2 class="fw-bold">{{ __('Join Our Marketplace') }}</h2>
        </div>
    </section>

    <section class="wsus__login padding-y-120 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 pt-5 px-5 text-center">
                            <h3 class="fw-bold text-dark mb-2">{{ __('Create Account') }}</h3>
                            <p class="text-muted small">{{ __('Join us today and start your journey') }}</p>
                        </div>

                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row g-4">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-user me-2 text-primary"></i>{{ __('Full Name') }}
                                            </label>
                                            <x-text-input id="name" class="form-control py-3 shadow-none" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name"
                                                placeholder="Enter your full name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-envelope me-2 text-primary"></i>{{ __('Email Address') }}
                                            </label>
                                            <x-text-input id="email" class="form-control py-3 shadow-none" type="email" name="email"
                                                :value="old('email')" required autocomplete="username"
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
                                                name="password" required autocomplete="new-password"
                                                placeholder="Create a strong password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-600 mb-2 text-dark">
                                                <i class="fas fa-shield-alt me-2 text-primary"></i>{{ __('Confirm Password') }}
                                            </label>
                                            <x-text-input id="password_confirmation" class="form-control py-3 shadow-none"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Repeat your password" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm fw-bold">
                                            <i class="fas fa-user-plus me-2"></i>{{ __('Register Now') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-5 text-center">
                            <p class="create_account mb-0 text-muted">
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


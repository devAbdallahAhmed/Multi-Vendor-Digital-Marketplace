@extends('frontend.layouts.master')

@section('content')
  <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1" 
         style="background: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}') center center/cover no-repeat;">
    <div class="breadcrumb-two">
        <img src="{{ asset('assets/front/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-two-content text-center py-4">

                        <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                            <li class="breadcrumb-item font-14">
                                <a href="{{ url('/') }}" class="text-body hover-text-main text-decoration-none">Home</a>
                            </li>
                            <li class="breadcrumb-item font-14">
                                <span class="font-10"><i class="fas fa-chevron-right"></i></span>
                            </li>
                            <li class="breadcrumb-item font-14 active" aria-current="page">
                                <span class="text-main">Sign In</span>
                            </li>
                        </ul>

                        <h3 class="mb-0 text-capitalize">{{ __('Sign In') }}</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="wsus__login py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0 text-center">
                            <h4 class="fw-bold text-dark mb-1">{{ __('Create Account') }}</h4>
                            <p class="text-muted small mb-0">{{ __('Join us today and start your journey') }}</p>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-semibold mb-1 small text-secondary">
                                                <i class="fas fa-user me-1 text-primary"></i>{{ __('Full Name') }}
                                            </label>
                                            <x-text-input id="name" class="form-control py-2 shadow-none"
                                                type="text" name="name" :value="old('name')" required autofocus
                                                autocomplete="name" placeholder="Enter your full name"
                                                style="border-radius: 8px;" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-semibold mb-1 small text-secondary">
                                                <i class="fas fa-envelope me-1 text-primary"></i>{{ __('Email Address') }}
                                            </label>
                                            <x-text-input id="email" class="form-control py-2 shadow-none"
                                                type="email" name="email" :value="old('email')" required
                                                autocomplete="username" placeholder="example@mail.com"
                                                style="border-radius: 8px;" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-semibold mb-1 small text-secondary">
                                                <i class="fas fa-lock me-1 text-primary"></i>{{ __('Password') }}
                                            </label>
                                            <x-text-input id="password" class="form-control py-2 shadow-none"
                                                type="password" name="password" required autocomplete="new-password"
                                                placeholder="Create a strong password" style="border-radius: 8px;" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label fw-semibold mb-1 small text-secondary">
                                                <i
                                                    class="fas fa-shield-alt me-1 text-primary"></i>{{ __('Confirm Password') }}
                                            </label>
                                            <x-text-input id="password_confirmation" class="form-control py-2 shadow-none"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" placeholder="Repeat your password"
                                                style="border-radius: 8px;" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 small" />
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-md w-100 py-2 shadow-sm fw-bold"
                                            style="background-color: #0061ff; border: none; border-radius: 8px;">
                                            <i class="fas fa-user-plus me-1"></i>{{ __('Register Now') }}
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-4 pt-0 text-center">
                            <p class="create_account mb-0 text-muted small">
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

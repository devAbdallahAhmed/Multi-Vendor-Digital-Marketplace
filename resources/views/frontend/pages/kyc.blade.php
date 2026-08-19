<style>
    .prem-breadcrumb {
        padding: 80px 0;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
    }

    .prem-breadcrumb::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.95));
        z-index: -1;
    }

    .prem-breadcrumb-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 2.5rem;
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
    <section class="prem-breadcrumb" style="background: url('{{ asset(config('settings.breadcrumb')) }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                        <li class="breadcrumb-item font-14"><a href="{{ route('home') }}"
                                class="text-white opacity-75 text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item font-14 text-white">Identity Verification</li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Identity Verification') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-9">

                    <div class="card login-card">
                        <div class="card-header login-card-header border-0 bg-white text-center">
                            <i class="fas fa-shield-alt text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h4 class="fw-800 text-dark mb-1">{{ __('Verify Your Identity') }}</h4>
                            <p class="text-muted small">{{ __('Select your document and upload clear copies') }}</p>
                        </div>

                        <div class="card-body login-card-body">
                            <form method="POST" action="{{ route('kyc.verification.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">

                                        <x-frontend.input-select name="document_type" :label="__('Document Type')" :required="true"
                                            class="form-select prem-input">
                                            <option value="" disabled selected>{{ __('Select Document Type') }}
                                            </option>
                                            @if ($kycSetting->nid_verifications == 1)
                                                <option value="nid">{{ __('National ID') }}</option>
                                            @endif
                                            @if ($kycSetting->passport_verifications == 1)
                                                <option value="passport">{{ __('Passport') }}</option>
                                            @endif
                                        </x-frontend.input-select>
                                    </div>

                                    <div class="col-12">

                                        <x-frontend.input-text name="document_number" :label="__('Document Number')"
                                            class="form-control prem-input" type="text" :required="true"
                                            placeholder="{{ __('Enter ID or Passport Number') }}" />
                                    </div>

                                    <div class="col-12">

                                        <x-frontend.input-text type="file" multiple name="documents[]" :label="__('Upload Document Scans')"
                                            :required="true" class="form-control prem-input"
                                            accept=".jpg,.jpeg,.png,.pdf" />
                                        <div class="form-text text-muted small mt-1">
                                            {{ __('Supported formats: JPG, PNG, PDF. Maximum size: 5MB.') }}
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100 prem-btn-submit">
                                            {{ __('Submit for Verification') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-white border-0 pb-4 pt-0 text-center">
                            <a href="{{ url()->previous() }}" class="text-muted text-decoration-none fw-medium small">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Dashboard') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

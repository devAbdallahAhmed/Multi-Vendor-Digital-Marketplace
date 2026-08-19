@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">

        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Account Settings') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.setting.pages.side-setting')

        <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card shadow-sm border-0 rounded-3">

                <div class="card-header bg-white border-bottom py-3 px-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:45px; height:45px; background: rgba(13,110,253,.1);">
                            <i class="bi bi-image text-primary fs-5"></i>
                        </div>
                        <div>
                            <h3 class="card-title mb-0 fw-bold">
                                {{ __('Logo & Favicon Settings') }}
                            </h3>
                            <small class="text-muted d-block mt-1">
                                {{ __('Manage your marketplace visual branding assets') }}
                            </small>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.logo-setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light text-center h-100">
                                    <x-admin.image-preview :src="isset($settings['logo']) ? asset($settings['logo']) : ''" />

                                    <div class="mt-3 text-start">
                                        <label class="form-label fw-semibold">{{ __('Main Logo') }}</label>
                                        <input type="file" name="logo" class="form-control">
                                        <small class="text-muted d-block mt-1">
                                            {{ __('Recommended size: 250x50px.') }}
                                        </small>
                                        @error('logo')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light text-center h-100">
                                    <x-admin.image-preview :src="isset($settings['footer_logo']) ? asset($settings['footer_logo']) : ''" />

                                    <div class="mt-3 text-start">
                                        <label class="form-label fw-semibold">{{ __('Footer Logo') }}</label>
                                        <input type="file" name="footer_logo" class="form-control">
                                        <small class="text-muted d-block mt-1">
                                            {{ __('Displayed in the footer area.') }}
                                        </small>
                                        @error('footer_logo')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light text-center h-100">
                                    <x-admin.image-preview :src="isset($settings['favicon']) ? asset($settings['favicon']) : ''" />

                                    <div class="mt-3 text-start">
                                        <label class="form-label fw-semibold">{{ __('Favicon') }}</label>
                                        <input type="file" name="favicon" class="form-control">
                                        <small class="text-muted d-block mt-1">
                                            {{ __('Recommended size: 64x64px (.png or .ico).') }}
                                        </small>
                                        @error('favicon')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light text-center h-100">
                                    <x-admin.image-preview :src="isset($settings['breadcrumb']) ? asset($settings['breadcrumb']) : ''" />

                                    <div class="mt-3 text-start">
                                        <label class="form-label fw-semibold">{{ __('Breadcrumb Background') }}</label>
                                        <input type="file" name="breadcrumb" class="form-control">
                                        <small class="text-muted d-block mt-1">
                                            {{ __('Background image for the page headers.') }}
                                        </small>
                                        @error('breadcrumb')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary rounded-3 px-4">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ __('Save Settings') }}
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection

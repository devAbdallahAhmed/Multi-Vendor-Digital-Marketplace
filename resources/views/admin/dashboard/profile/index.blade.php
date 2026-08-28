@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">

                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-bottom py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width:45px; height:45px; background: rgba(13,110,253,.1);">
                                        <i class="bi bi-person-fill text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <h3 class="card-title mb-0 fw-bold">
                                            {{ __('Edit Profile') }}
                                        </h3>
                                        <small class="text-muted">
                                            {{ __('Manage your personal information and avatar') }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ auth()->user('admin')->avatar ? asset(auth()->user('admin')->avatar) : asset('default-avatar.png') }}"
                                                alt="Profile Picture" class="rounded-circle shadow-sm" width="100"
                                                height="100" style="object-fit: cover;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="file" name="avatar" :label="__('Profile Picture')"
                                                    :value="auth()->user('admin')->avatar" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="text" name="name" :label="__('Full Name')"
                                                    :value="auth()->user('admin')->name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="email" name="email" :label="__('Email')"
                                                    :value="auth()->user('admin')->email" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="text" name="address" :label="__('Address')"
                                                    :value="auth()->user('admin')->address" />
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-admin.input-select name="country" class="tom-select-class"
                                                            label="{{ __('Country') }}">
                                                            <option value="">{{ __('Select Country') }}</option>
                                                            @foreach (config('option.countries', []) as $key => $country)
                                                                @php
                                                                    $countryName = is_array($country)
                                                                        ? $country['name']
                                                                        : $country;
                                                                @endphp
                                                                <option value="{{ $countryName }}"
                                                                    @selected(old('country', auth()->user('admin')->country ?? config('settings.country')) == $countryName)>
                                                                    {{ $countryName }}
                                                                </option>
                                                            @endforeach
                                                        </x-admin.input-select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <x-admin.input-text type="text" name="city" :label="__('State')"
                                                            :value="auth()->user('admin')->city" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="about" :label="__('About Me')">
                                                    {{ auth()->user('admin')->about }}
                                                </x-admin.input-textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3 text-end">
                                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">
                                        <i class="bi bi-check-circle me-1"></i> {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-white border-bottom py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width:45px; height:45px; background: rgba(220,53,69,.1);">
                                        <i class="bi bi-shield-lock-fill text-danger fs-5"></i>
                                    </div>
                                    <div>
                                        <h3 class="card-title mb-0 fw-bold">
                                            {{ __('Update Password') }}
                                        </h3>
                                        <small class="text-muted">
                                            {{ __('Ensure your account is using a secure password') }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.profile.updatePassword') }}">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="password" :placeholder="__('Current Password')"
                                                    name="current_password" :label="__('Current Password')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="password" :placeholder="__('New Password')" name="password"
                                                    :label="__('New Password')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text type="password" name="password_confirmation"
                                                    :placeholder="__('Confirm New Password')" :label="__('Confirm New Password')" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3 text-end">
                                    <button type="submit" class="btn btn-danger rounded-3 px-4 fw-bold">
                                        <i class="bi bi-check-circle me-1"></i> {{ __('Update Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


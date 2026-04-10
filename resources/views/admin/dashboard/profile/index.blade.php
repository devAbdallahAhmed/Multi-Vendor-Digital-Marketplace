@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                    <div class="row row-cards">
                <form class="card" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('Edit Profile') }}</h3>

                        <div class="row row-cards">


                            <div class="col-md-6 mb-4">
                                <img src="{{ auth()->user('admin')->avatar ? asset(auth()->user('admin')->avatar) : asset('default-avatar.png') }}"
                                    alt="Profile Picture" class="rounded-circle mb-3" width="110" height="110">
                            </div>
                            <div class="col-md-6 mb-4">
                                <x-admin.input-text type="file" name="avatar" :label="__('Profile Picture')" :value="auth()->user('admin')->avatar" />
                            </div>

                            <div class="col-sm-6 col-md-6 mb-3">
                                <x-admin.input-text type="text" name="name" :label="__('Full Name')" :value="auth()->user('admin')->name" />
                            </div>

                            <div class="col-sm-6 col-md-6 mb-3">
                                <x-admin.input-text type="email" name="email" :label="__('Email')" :value="auth()->user('admin')->email" />
                            </div>

                             <div class="col-sm-6 col-md-4 mb-3">
                                <x-admin.input-text type="text" name="address" :label="__('Address')" :value="auth()->user('admin')->address" />
                            </div>
                            <div class="col-md-8">
                                @livewire('admin.location-selector', [
                                    'selectedCountry' => auth()->user('admin')->country,
                                    'selectedState' => auth()->user('admin')->city,
                                ])
                            </div>

                            <div class="col-md-12 mt-3 mb-3">
                                <x-admin.input-textarea name="about" :label="__('About Me')">
                                    {{ auth()->user('admin')->about }}
                                </x-admin.input-textarea>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="ti ti-device-floppy me-1"></i> {{ __('Update Profile') }}
                        </button>
                    </div>
                </form>
            </div>
 
                 <div class="col-12 mt-4">
                    <form class="card" method="POST" action="{{ route('admin.profile.updatePassword') }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h3 class="card-title">{{ __('Update Password') }}</h3>
                            <div class="row row-cards">
                                <div class="col-md-12 mb-3">
                                    <x-admin.input-text type="password" :placeholder="__('Current Password')" name="current_password" :label="__('Current Password')" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-admin.input-text type="password" :placeholder="__('New Password')" name="password" :label="__('New Password')" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-admin.input-text type="password" name="password_confirmation" :placeholder="__('Confirm New Password')" :label="__('Confirm New Password')" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary fw-bold">{{ __('Update Password') }}</button>
                        </div>
                    </form>
                </div>

            </div> 
        </div> 
    </div>
    
</div> 
@endsection

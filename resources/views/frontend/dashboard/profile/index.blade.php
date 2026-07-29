@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="dashboard-body__content">
        <div class="profile">
            <div class="row gy-4">

                <div class="col-xxl-4 col-xl-4 col-lg-5">
                    <div class="profile-info card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="profile-info__inner mb-4 text-center">
                                <div class="avatar-upload mb-3 d-inline-block position-relative">
                                    <div class="avatar-preview rounded-circle shadow-sm"
                                        style="background-image: url({{ asset($user->avatar) }}); width: 120px; height: 120px; background-size: cover; background-position: center; border: 4px solid #fff;">
                                        <div id="imagePreview"></div>
                                    </div>
                                </div>
                                <h4 class="profile-info__name mb-1 fw-bold">{{ $user->name }}</h4>
                                <span
                                    class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill font-14">{{ $user->user_type }}</span>
                            </div>

                            <hr class="my-4 text-muted">

                            <ul class="profile-info-list list-unstyled m-0 d-flex flex-column gap-3">
                                <li class="profile-info-list__item d-flex justify-content-between align-items-center">
                                    <span class="profile-info-list__content d-flex align-items-center gap-2 text-muted">
                                        <i class="ti ti-user font-20"></i>
                                        <span class="fw-500">{{ __('Full Name') }}</span>
                                    </span>
                                    <span class="profile-info-list__info text-dark fw-semibold">{{ $user->name }}</span>
                                </li>
                                <li class="profile-info-list__item d-flex justify-content-between align-items-center">
                                    <span class="profile-info-list__content d-flex align-items-center gap-2 text-muted">
                                        <i class="ti ti-mail font-20"></i>
                                        <span class="fw-500">{{ __('Email') }}</span>
                                    </span>
                                    <span class="profile-info-list__info text-dark fw-semibold">{{ $user->email }}</span>
                                </li>
                                <li class="profile-info-list__item d-flex justify-content-between align-items-center">
                                    <span class="profile-info-list__content d-flex align-items-center gap-2 text-muted">
                                        <i class="ti ti-map-pin font-20"></i>
                                        <span class="fw-500">{{ __('Country') }}</span>
                                    </span>
                                    <span class="profile-info-list__info text-dark fw-semibold">{{ $user->country }}</span>
                                </li>
                                <li class="profile-info-list__item d-flex justify-content-between align-items-center">
                                    <span class="profile-info-list__content d-flex align-items-center gap-2 text-muted">
                                        <i class="ti ti-currency-dollar font-20"></i>
                                        <span class="fw-500">{{ __('Balance') }}</span>
                                    </span>
                                    <span class="profile-info-list__info text-success fw-bold">{{ __('$0.00 USD') }}</span>
                                </li>
                                <li class="profile-info-list__item d-flex justify-content-between align-items-center">
                                    <span class="profile-info-list__content d-flex align-items-center gap-2 text-muted">
                                        <i class="ti ti-basket-check font-20"></i>
                                        <span class="fw-500">{{ __('Purchased') }}</span>
                                    </span>
                                    <span class="profile-info-list__info text-dark fw-semibold">{{ __('0 items') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-8 col-xl-8 col-lg-7">
                    <div class="dashboard-card card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <ul class="nav tab-bordered nav-pills d-flex gap-2" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-16 fw-600 active px-4 py-2 rounded-pill"
                                        id="pills-personalInfo-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-personalInfo" type="button" role="tab"
                                        aria-controls="pills-personalInfo" aria-selected="true">
                                        <i class="ti ti-user-edit me-1"></i> {{ __('Personal Info') }}
                                    </button>
                                </li>
                                @can('is-author')
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link font-16 fw-600 px-4 py-2 rounded-pill" id="pills-payouts-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-payouts" type="button" role="tab"
                                            aria-controls="pills-payouts" aria-selected="false">
                                            <i class="ti ti-building-bank me-1"></i> {{ __('Payouts') }}
                                        </button>
                                    </li>
                                @endcan

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-16 fw-600 px-4 py-2 rounded-pill"
                                        id="pills-changePassword-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-changePassword" type="button" role="tab"
                                        aria-controls="pills-changePassword" aria-selected="false">
                                        <i class="ti ti-lock-access me-1"></i> {{ __('Security') }}
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-personalInfo" role="tabpanel"
                                    aria-labelledby="pills-personalInfo-tab" tabindex="0">
                                    <form action="{{ route('profile.update') }}" autocomplete="off" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="name" :label="__('Full Name')"
                                                    value="{{ $user->name }}" :placeholder="__('Enter your full name')" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text type="file" name="avatar" :label="__('Profile Picture')" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="email" :label="__('Email Address')"
                                                    value="{{ $user->email }}" :placeholder="__('Enter email address')" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-select name="country" :label="__('Country')">
                                                    <option value="">{{ __('Select Country') }}</option>
                                                    @foreach (config('option.countries') as $key => $value)
                                                        <option @selected($user->country == $value) value="{{ $value }}">
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </x-frontend.input-select>
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="city" :label="__('City')" :value="$user->city"
                                                    :placeholder="__('Enter your city')" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="address" :label="__('Address')" :value="$user->address"
                                                    :placeholder="__('Enter detailed address')" />
                                            </div>
                                            <div class="col-12 mt-4 text-end">
                                                <button type="submit" class="btn btn-main btn-lg px-5 rounded-pill">
                                                    <i class="ti ti-device-floppy me-2"></i> {{ __('Save Changes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-payouts" role="tabpanel"
                                    aria-labelledby="pills-payouts-tab" tabindex="0">
                                    <form action="{{ route('user.withdraw_AuthorInfo') }}" autocomplete="off"
                                        method="POST">
                                        @csrf
                                        <div class="row gy-4">

                                            <div class="col-12">
                                                <div class="form_box">
                                                    <label for="withdraw_method" class="form-label mb-2 font-16 fw-600">
                                                        {{ __('Select Payout Method') }}
                                                    </label>
                                                    <div class="select-has-icon">
                                                        <select class="common-input border form-select"
                                                            id="withdraw_method" name="withdraw_method_id">
                                                            <option value="" disabled>{{ __('Choose a method...') }}
                                                            </option>
                                                            @foreach ($withdrawMethod ?? [] as $method)
                                                                <option @selected($user->withdrawAuthorInfo?->withdraw_method_id == $method->id)
                                                                    value="{{ $method->id }}">
                                                                    {{ $method->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div id="method_instructions_container">
                                                    @foreach ($withdrawMethod ?? [] as $method)
                                                        <div class="alert alert-info method-instruction method-{{ $method->id }} {{ $user->withdrawAuthorInfo?->withdraw_method_id == $method->id ? '' : 'd-none' }} shadow-sm border-0 border-start border-4 border-info"
                                                            role="alert">
                                                            <h6 class="alert-heading fw-bold mb-2">
                                                                <i class="ti ti-info-circle me-1"></i>
                                                                {{ __('Instructions') }}
                                                            </h6>
                                                            <p class="mb-0 font-14 text-dark">{!! nl2br(e($method->description)) !!}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form_box">
                                                    <x-frontend.textarea name="information" id="payout_details"
                                                        :label="__('Payout Account Details')"
                                                        placeholder="{{ __('Provide your PayPal email or Bank Account information here based on the selected method...') }}">
                                                        {{ $user->withdrawAuthorInfo?->information }}
                                                    </x-frontend.textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-4 text-end">
                                                <button type="submit" class="btn btn-main btn-lg px-5 rounded-pill">
                                                    <i class="ti ti-check me-2"></i> {{ __('Update Payout Settings') }}
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-changePassword" role="tabpanel"
                                    aria-labelledby="pills-changePassword-tab" tabindex="0">
                                    <form action="{{ route('profile.updatePassword') }}" method="POST"
                                        autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gy-4">
                                            <div class="col-12">
                                                <x-frontend.input-text name="current_password" type="password"
                                                    :label="__('Current Password')" placeholder="••••••••" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="password" type="password" :label="__('New Password')"
                                                    placeholder="••••••••" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-frontend.input-text name="password_confirmation" type="password"
                                                    :label="__('Confirm New Password')" placeholder="••••••••" />
                                            </div>
                                            <div class="col-12 mt-4 text-end">
                                                <button type="submit" class="btn btn-main btn-lg px-5 rounded-pill">
                                                    <i class="ti ti-shield-lock me-2"></i> {{ __('Update Password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodSelect = document.getElementById('withdraw_method');
            const instructions = document.querySelectorAll('.method-instruction');

            if (methodSelect) {
                methodSelect.addEventListener('change', function() {
                    instructions.forEach(instruction => {
                        instruction.classList.add('d-none');
                    });

                    const selectedId = this.value;
                    if (selectedId) {
                        const targetInstruction = document.querySelector('.method-' + selectedId);
                        if (targetInstruction) {
                            targetInstruction.classList.remove('d-none');
                        }
                    }
                });
            }
        });
    </script>
@endpush

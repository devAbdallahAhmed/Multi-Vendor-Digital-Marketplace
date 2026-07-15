@extends('admin.payment-setting.index')

@section('payment_content')
    <div class="card shadow-sm border-0 rounded-3">

        {{-- Header --}}
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width:45px; height:45px; background: rgba(13,110,253,.1);">
                    <i class="bi bi-gear-fill text-primary fs-5"></i>
                </div>
                <div>
                    <h3 class="card-title mb-0 fw-bold">
                        {{ __('Paypal Settings') }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.paypal.setting') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- PayPal Mode (Full Width) --}}
                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 bg-light">
                            <x-admin.input-select name="paypal_mode" class="tom-select-class"
                                label="{{ __('PayPal Mode') }}">
                                <option @selected(config('settings.paypal_mode') == 'sandbox') value="sandbox">{{ __('Sandbox (Testing)') }}</option>
                                <option @selected(config('settings.paypal_mode') == 'live') value="live">{{ __('Live (Real Money)') }}</option>
                            </x-admin.input-select>
                            <small class="text-muted d-block mt-2">
                                {{ __('Select Sandbox for development testing, and Live for real transactions.') }}
                            </small>
                        </div>
                    </div>

                    {{-- PayPal App ID (Half Width) --}}
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light">
                            <x-admin.input-text name="paypal_app_id" label="{{ __('App ID') }}"
                                value="{{ config('settings.paypal_app_id') }}"
                                placeholder="{{ __('Enter PayPal App ID') }}" />
                        </div>
                    </div>

                    {{-- PayPal Client ID (Half Width) --}}
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light">
                            <x-admin.input-text name="paypal_client_id" label="{{ __('Client ID') }}"
                                value="{{ config('settings.paypal_client_id') }}"
                                placeholder="{{ __('Enter PayPal Client ID') }}" />
                        </div>
                    </div>

                    {{-- PayPal Secret Key (Full Width) --}}
                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 bg-light">
                            <x-admin.input-text name="paypal_secret_key" label="{{ __('Secret Key') }}"
                                value="{{ config('settings.paypal_secret_key') }}"
                                placeholder="{{ __('Enter PayPal Secret Key') }}" />
                            <small class="text-muted d-block mt-2">
                                {{ __('Keep this key secure. It is required for API authentication.') }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 bg-light">
                            <x-admin.input-select name="paypal_status" class="tom-select-class"
                                label="{{ __('PayPal Status') }}">
                                <option  @selected(config('settings.paypal_status') == 'active') value="active">{{ __('Active') }}</option>
                                <option  @selected(config('settings.paypal_status') == 'inactive') value="inactive">{{ __('Inactive') }}</option>
                            </x-admin.input-select>
                            <small class="text-muted d-block mt-2">
                                {{ __('Select Sandbox for development testing, and Live for real transactions.') }}
                            </small>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-white border-top px-4 py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="text-muted small">
                        <i class="bi bi-shield-lock me-1"></i>
                        {{ __('Only administrators can update these settings.') }}
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ __('Save Settings') }}
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

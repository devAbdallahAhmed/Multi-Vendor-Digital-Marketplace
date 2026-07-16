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
                        {{ __('Stripe Settings') }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.stripe.setting') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body p-4">
            <div class="row g-4">

                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">
                        <x-admin.input-text name="stripe_publishable_key" label="{{ __('Stripe Publishable Key') }}"
                            value="{{ config('settings.stripe_publishable_key') }}"
                            placeholder="{{ __('Enter Stripe Publishable Key') }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">
                        <x-admin.input-text name="stripe_secret_key" label="{{ __('Stripe Secret Key') }}"
                            value="{{ config('settings.stripe_secret_key') }}"
                            placeholder="{{ __('Enter Stripe Secret Key') }}" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="border rounded-3 p-3 bg-light">
                        <x-admin.input-select name="stripe_status" class="tom-select-class"
                            label="{{ __('Stripe Status') }}">
                            <option @selected(config('settings.stripe_status') == 'active') value="active">{{ __('Active') }}</option>
                            <option @selected(config('settings.stripe_status') == 'inactive') value="inactive">{{ __('Inactive') }}</option>
                        </x-admin.input-select>
                    </div>
                </div>

            </div>
        </div>

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

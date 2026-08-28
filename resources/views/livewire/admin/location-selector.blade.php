<div class="row">
    {{-- Country Selection --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label mb-2 font-18 font-heading fw-600">{{ __('Country') }}</label>
            <div class="form_box">
                <select wire:model.live="selectedCountry" name="country"
                    class="form-select tom-select-class @error('country') is-invalid @enderror">
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach ($countries as $code => $name)
                        @php
                            $countryName = is_array($name) ? $name['name'] : $name;
                        @endphp
                        <option value="{{ $countryName }}" @selected($selectedCountry == $countryName)>
                            {{ __($countryName) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- State Selection --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label
                class="form-label mb-2 font-18 font-heading fw-600 d-flex justify-content-between align-items-center">
                <span>{{ __('State') }}</span>
                <span wire:loading wire:target="selectedCountry"
                    class="spinner-border spinner-border-sm text-primary"></span>
            </label>
            <div class="form_box">
                <select wire:model="selectedState" name="city"
                    class="common-input border form-control form-select  tom-select-class"
                    {{ empty($states) ? 'disabled' : '' }}>
                    <option value="">{{ __('Select State') }}</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}" @selected($selectedState == $state)>
                            {{ __($state) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<style>
    .form_box {
        position: relative !important;
        overflow: visible !important;
    }

    .ts-wrapper.single.dropdown-active .ts-dropdown,
    .ts-dropdown {
        top: 100% !important;
        bottom: auto !important;
        transform: none !important;
        margin-top: 5px !important;
        position: absolute !important;
        left: 0 !important;
        right: auto !important;
        width: 100% !important;
        z-index: 999999 !important;
        border-radius: 8px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        border: 1px solid #eaeaea !important;
        background: #fff !important;
    }

    .col-md-6,
    .row,
    .container-xl,
    .page-body,
    .page-wrapper {
        overflow: visible !important;
    }
</style>

<div class="row">
    {{-- Country Selection --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label mb-2 font-18 font-heading fw-600 select_2">{{ __('Country') }}</label>
            <div class="form_box">
                <select wire:model.live="selectedCountry" name="country" 
                    class="common-input border form-control form-select select_2">
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach ($countries as $code => $name)
                        @php $countryName = is_array($name) ? $name['name'] : $name; @endphp
                        <option value="{{ $countryName }}">{{ __($countryName) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- State Selection --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label mb-2 font-18 font-heading fw-600 select_2">
                {{ __('State') }}
                <span wire:loading wire:target="selectedCountry" class="spinner-border spinner-border-sm text-primary ms-2"></span>
            </label>
            <div class="form_box">
                <select wire:model="selectedState" name="city" 
                    class="common-input border form-control form-select select_2"
                    {{ empty($states) ? 'disabled' : '' }}>
                    <option value="">{{ __('Select State') }}</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}">{{ __($state) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

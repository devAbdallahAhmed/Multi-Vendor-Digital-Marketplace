@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('KYC Settings') }}</h3>
                            </div>

                            <form action="{{ route('admin.kyc-setting.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div col-md-2>
                                            <label for="" class="form-label">Verifications Type</label>
                                        </div>
                                        <div class="col-md-4">
                                            <x-admin.label-check name="nid_verifications" :label="__('NID Verification')"
                                            :checked="$kycSetting?->nid_verifications"
                                            />
                                        </div>

                                        <div class="col-md-4">
                                            <x-admin.label-check name="passport_verifications" :label="__('Passport Verification')"
                                            :checked="$kycSetting?->passport_verifications"
                                            />
                                        </div>
                                        <div class="col-md-12">
                                            <x-admin.input-textarea name="instructions" :label="__('Instructions')" :value="$kycSetting?->instructions" />
                                        </div>
                                        <hr>
                                           <div class="col-md-6">
                                            <x-admin.input-select name="auto_approve" :label="__('Auto Approve')">
                                                <option @selected($kycSetting?->auto_approve == 1) value="1">Enable</option>
                                                <option @selected($kycSetting?->auto_approve == 0 ) value="0">Disable</option>

                                            </x-admin.input-select>

                                        </div>
                                        <div class="col-md-6">
                                            <x-admin.input-select name="status" :label="__('KYC Status')">
                                                <option @selected($kycSetting?->status== 1) value="1">Active</option>
                                                <option  @selected($kycSetting?->status== 0) value="0">Inactive</option>

                                            </x-admin.input-select>

                                        </div>

                                    </div>
                                </div>

                                    <hr>
                                <div class="card-footer text-end border-0">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary ms-auto fw-bold border-0">
                                            {{ __('Save Settings') }}
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
@endsection

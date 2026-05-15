@extends('frontend.layouts.master')

@section('content')
<section class="kyc-section padding-y-120 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">{{ __('Identity Verification') }}</h3>
                            <p class="text-muted small">{{ __('Select your document and upload clear copies') }}</p>
                        </div>

                        <form method="POST" action="{{ route('kyc.verification.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <x-frontend.input-select
                                        name="document_type"
                                        :label="__('Document Type')"
                                        :required="true"
                                    >
                                        @if ($kycSetting->nid_verifications == 1)
                                            <option value="nid">National ID</option>
                                        @endif
                                        @if ($kycSetting->passport_verifications == 1)
                                            <option value="passport">Passport</option>
                                        @endif
                                    </x-frontend.input-select>
                                </div>

                                <div class="col-md-12">
                                    <x-frontend.input-text
                                        name="document_number"
                                        :label="__('Document Number')"
                                        placeholder="Enter ID or Passport Number"
                                        :required="true"
                                    />
                                </div>

                                <div class="col-md-12">
                                    <x-frontend.input-text
                                        type="file"
                                        multiple
                                        name="documents[]"
                                        :label="__('Upload Document Scans')"
                                        :required="true"
                                    />
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm py-3">
                                        {{ __('Submit for Verification') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

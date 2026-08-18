@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Contact Information') }}</h3>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('admin.contact-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="phone_1" label="{{ __('Phone 1') }}"
                                                    value="{{ old('phone_1', $settings['contact_phone_1'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="phone_2" label="{{ __('Phone 2') }}"
                                                    value="{{ old('phone_2', $settings['contact_phone_2'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="email_1" label="{{ __('Email 1') }}"
                                                    value="{{ old('email_1', $settings['contact_email_1'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="email_2" label="{{ __('Email 2') }}"
                                                    value="{{ old('email_2', $settings['contact_email_2'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="link_1" label="{{ __('Website Link 1') }}"
                                                    value="{{ old('link_1', $settings['contact_link_1'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="link_2" label="{{ __('Website Link 2') }}"
                                                    value="{{ old('link_2', $settings['contact_link_2'] ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="map"
                                                    label="{{ __('Google Map iFrame') }}"
                                                    value="{{ old('map', $settings['contact_map'] ?? '') }}"
                                                    rows="4" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3"
                                    style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                                        <i class="ti ti-device-floppy me-1"></i>
                                        {{ __('Save Changes') }}
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

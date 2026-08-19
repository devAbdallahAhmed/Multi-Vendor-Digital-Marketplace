@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">

        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Account Settings') }}</h2>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.setting.pages.side-setting')

        <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card shadow-sm border-0 rounded-3">

                <div class="card-header bg-white border-bottom py-3 px-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:45px; height:45px; background: rgba(13,110,253,.1);">
                            <i class="bi bi-envelope-fill text-primary fs-5"></i>
                        </div>
                        <div>
                            <h3 class="card-title mb-0 fw-bold">
                                {{ __('SMTP Settings') }}
                            </h3>
                            <small class="text-muted d-block mt-1">
                                {{ __('Configure your mail server parameters') }}
                            </small>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.smtp-setting.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_sender_name" label="{{ __('Sender Name') }}"
                                        value="{{ config('settings.smtp_sender_name') }}" placeholder="e.g. DigStore Support" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_sender_email" label="{{ __('Sender Email') }}"
                                        value="{{ config('settings.smtp_sender_email') }}" placeholder="e.g. no-reply@example.com" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_recipient_email" label="{{ __('Recipient Email') }}"
                                        value="{{ config('settings.smtp_recipient_email') }}" placeholder="e.g. admin@example.com" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_host" label="{{ __('Mail Host') }}"
                                        value="{{ config('settings.smtp_host') }}" placeholder="e.g. smtp.mailtrap.io" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_username" label="{{ __('SMTP Username') }}"
                                        value="{{ config('settings.smtp_username') }}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_password" label="{{ __('SMTP Password') }}"
                                        value="{{ config('settings.smtp_password') }}" type="password" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-text name="smtp_port" label="{{ __('SMTP Port') }}"
                                        value="{{ config('settings.smtp_port') }}" placeholder="e.g. 587" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light h-100">
                                    <x-admin.input-select name="smtp_encryption" class="tom-select-class" label="{{ __('SMTP Encryption') }}">
                                        <option value="tls" @selected(config('settings.smtp_encryption') == 'tls')>TLS</option>
                                        <option value="ssl" @selected(config('settings.smtp_encryption') == 'ssl')>SSL</option>
                                    </x-admin.input-select>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary rounded-3 px-4">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ __('Save Settings') }}
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection

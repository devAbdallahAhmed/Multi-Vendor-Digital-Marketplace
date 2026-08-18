@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Update Counter Section') }}</h3>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('admin.counter-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <x-admin.input-text name="title" label="{{ __('Title') }}"
                                                value="{{ old('title', $counterSection->title ?? '') }}" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-admin.input-text name="subtitle" label="{{ __('Subtitle') }}"
                                                value="{{ old('subtitle', $counterSection->subtitle ?? '') }}" />
                                        </div>

                                        <hr>

                                        <div class="col-md-6">
                                            <x-admin.input-text name="label_1" label="{{ __('Label 1') }}"
                                                value="{{ old('label_1', $counterSection->label_1 ?? '') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-admin.input-text name="counter_1" label="{{ __('Counter 1') }}"
                                                value="{{ old('counter_1', $counterSection->counter_1 ?? '') }}" />
                                        </div>

                                        <div class="col-md-6">
                                            <x-admin.input-text name="label_2" label="{{ __('Label 2') }}"
                                                value="{{ old('label_2', $counterSection->label_2 ?? '') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-admin.input-text name="counter_2" label="{{ __('Counter 2') }}"
                                                value="{{ old('counter_2', $counterSection->counter_2 ?? '') }}" />
                                        </div>

                                        <div class="col-md-6">
                                            <x-admin.input-text name="label_3" label="{{ __('Label 3') }}"
                                                value="{{ old('label_3', $counterSection->label_3 ?? '') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-admin.input-text name="counter_3" label="{{ __('Counter 3') }}"
                                                value="{{ old('counter_3', $counterSection->counter_3 ?? '') }}" />
                                        </div>

                                        <div class="col-md-6">
                                            <x-admin.input-text name="label_4" label="{{ __('Label 4') }}"
                                                value="{{ old('label_4', $counterSection->label_4 ?? '') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-admin.input-text name="counter_4" label="{{ __('Counter 4') }}"
                                                value="{{ old('counter_4', $counterSection->counter_4 ?? '') }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3">
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

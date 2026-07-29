@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Update Withdrawal Method') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.withdraw-method.index') }}" class="btn btn-primary">
                                    <span><i class="ti ti-arrow-back-up"></i></span>
                                    {{ __('Go Back') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            {{-- Form --}}
                            <form action="{{ route('admin.withdraw-method.update' ,$withdrawalMethod->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="name" label="{{ __('Name') }}"
                                                    placeholder="{{ __('Enter Name') }}" :value="$withdrawalMethod->name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="minimum_amount"
                                                    label="{{ __(' Minimum Amount') }}"
                                                    placeholder="{{ __('Enter Minimum Amount') }}" :value="$withdrawalMethod->minimum_amount" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="maximum_amount"
                                                    label="{{ __(' Maximum Amount') }}"
                                                    placeholder="{{ __('Enter Maximum Amount') }}" :value="$withdrawalMethod->maximum_amount" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-select name="status" class="tom-select-class"
                                                    label="{{ __('Status') }}">
                                                    <option @selected($withdrawalMethod->status == 1) value="1">
                                                        {{ __('Active') }}</option>
                                                        <option @selected($withdrawalMethod->status == 0) value="0">
                                                            {{ __('Inactive') }}</option>
                                                </x-admin.input-select>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="description" label="{{ __('Description') }}"
                                                    placeholder="{{ __('EnterDescription') }}" :value="$withdrawalMethod->description" />
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
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="card-footer text-end">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

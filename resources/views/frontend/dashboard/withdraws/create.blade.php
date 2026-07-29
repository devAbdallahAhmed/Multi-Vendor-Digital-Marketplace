@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <!-- Analytics Cards Row -->
                <div class="row mb-4 gy-4">
                    <!-- Current Balance -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small mb-1">
                                            {{ __('Current Balance') }}
                                        </div>
                                        <h4 class="fw-bold mb-0 text-success">
                                            {{ currencyPosition(auth()->user()->balance ?? 0) }}
                                        </h4>
                                    </div>
                                    <div class="icon-box bg-success-subtle text-success rounded-3 p-2 display-6">
                                        <i class="ti ti-wallet"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Withdraw -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small mb-1">
                                            {{ __('Pending Withdraw') }}
                                        </div>
                                        <h4 class="fw-bold mb-0 text-warning">
                                            {{ currencyPosition(auth()->user()->withdraws()->where('status', 'pending')->sum('amount')) }}
                                        </h4>
                                    </div>
                                    <div class="icon-box bg-warning-subtle text-warning rounded-3 p-2 display-6">
                                        <i class="ti ti-hourglass-low"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Withdraw (Paid) -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small mb-1">
                                            {{ __('Total Withdraw') }}
                                        </div>
                                        <h4 class="fw-bold mb-0 text-danger">
                                            {{ currencyPosition(auth()->user()->withdraws()->where('status', 'paid')->sum('amount')) }}
                                        </h4>
                                    </div>
                                    <div class="icon-box bg-danger-subtle text-danger rounded-3 p-2 display-6">
                                        <i class="ti ti-cash-banknote"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Earnings -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small mb-1">
                                            {{ __('Total Earnings') }}
                                        </div>
                                        <h4 class="fw-bold mb-0 text-primary">
                                            {{ currencyPosition(auth()->user()->authorSales()->sum('author_earning')) }}
                                        </h4>
                                    </div>
                                    <div class="icon-box bg-primary-subtle text-primary rounded-3 p-2 display-6">
                                        <i class="ti ti-report-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Withdraw Request Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-white border-bottom-0 pt-4 pb-0 px-4">
                                <h4 class="card-title mb-0 fw-bold">{{ __('Create Withdraw Request') }}</h4>
                                <a href="{{ route('user.withdraw.index') }}"
                                    class="btn btn-primary rounded-pill px-4 shadow-sm">
                                    <span><i class="ti ti-arrow-back-up me-1"></i></span>
                                    {{ __('Go Back') }}
                                </a>
                            </div>
                            <div class="card-body p-4">

                                <div class="table-responsive mb-4">
                                    <table class="table table-bordered table-striped rounded overflow-hidden">
                                        <tbody>
                                            <tr>
                                                <td class="fw-semibold text-muted w-25">{{ __('Payment Method') }}</td>
                                                <td class="fw-bold text-dark text-start">
                                                    {{ auth()->user()?->withdrawAuthorInfo?->withdrawGateway?->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">{{ __('Account Info') }}</td>
                                                <td class="text-dark text-start">
                                                    {!! nl2br(e(auth()->user()?->withdrawAuthorInfo?->information)) !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">{{ __('Minimum Withdraw Amount') }}</td>
                                                <td class="text-danger fw-bold text-start">
                                                    {{ currencyPosition(auth()->user()?->withdrawAuthorInfo?->withdrawGateway?->minimum_amount) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-muted">{{ __('Maximum Withdraw Amount') }}</td>
                                                <td class="text-success fw-bold text-start">
                                                    {{ currencyPosition(auth()->user()?->withdrawAuthorInfo?->withdrawGateway?->maximum_amount) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <form action="{{ route('user.withdraw.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form_box">
                                                <label for="amount" class="form-label mb-2 font-16 fw-600">
                                                    {{ __('Withdraw Amount') }} <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" step="0.01" name="amount" id="amount"
                                                    class="common-input border form-control @error('amount') is-invalid @enderror"
                                                    placeholder="{{ __('Enter amount to withdraw') }}"
                                                    value="{{ old('amount') }}" required>

                                                @error('amount')
                                                    <span
                                                        class="text-danger mt-2 d-block fw-semibold">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4 text-end">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                                                <i class="ti ti-send me-2"></i> {{ __('Submit Request') }}
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
    </div>
@endsection

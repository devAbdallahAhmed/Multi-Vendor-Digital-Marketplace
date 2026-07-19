@extends('frontend.dashboard.layouts.master')

@section('content')
    <style>
        .stat-card {
            transition: all .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, .08) !important;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
    </style>

    <div class="container-xl py-4">

        @if (auth()->user()->latestKyc?->status === 'pending')
            <div class="alert alert-warning fade show border-0 shadow-sm rounded-4 d-flex align-items-center gap-3 p-4 mb-4"
                role="alert">

                <div class="bg-warning-subtle text-warning rounded-4 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:48px;height:48px;">
                    <i class="ti ti-alert-hexagon fs-3"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Information Under Review
                    </h5>
                    <p class="text-muted mb-0">
                        Your KYC documents are being reviewed. We will notify you once approved.
                    </p>
                </div>

                <button type="button" class="btn-close ms-auto m-0" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1 text-dark">
                        Welcome back 👋 {{ Auth::user()->name }}
                    </h4>
                    <p class="text-muted mb-0">
                        Here’s your activity summary for today.
                    </p>
                </div>
                <div class="text-end">
                    <div class="text-muted small">
                        Available Balance
                    </div>
                    <h3 class="fw-bold text-success mb-0">
                        $580.00
                    </h3>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-xl-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Products
                                </div>
                                <h4 class="fw-bold mb-0">
                                    2M+
                                </h4>
                            </div>
                            <div class="icon-box bg-primary-subtle text-primary">
                                <i class="ti ti-list-details"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Earnings
                                </div>
                                <h4 class="fw-bold mb-0 text-success">
                                    $5289
                                </h4>
                            </div>
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="ti ti-currency-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Downloads
                                </div>
                                <h4 class="fw-bold mb-0">
                                    5,245
                                </h4>
                            </div>
                            <div class="icon-box bg-info-subtle text-info">
                                <i class="ti ti-download"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Sales
                                </div>
                                <h4 class="fw-bold mb-0">
                                    2,589
                                </h4>
                            </div>
                            <div class="icon-box bg-danger-subtle text-danger">
                                <i class="ti ti-basket-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

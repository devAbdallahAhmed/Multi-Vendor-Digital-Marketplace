@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper bg-light min-vh-100">

        <!-- Page Header -->
        <div class="page-header d-print-none py-4">
            <div class="container-xl">

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                    <!-- Left -->
                    <div>

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <span class="badge bg-primary-lt text-primary px-3 py-2 rounded-pill fw-semibold">
                                Dashboard
                            </span>

                            <span class="text-muted small">
                                Overview & Analytics
                            </span>

                        </div>

                        <h1 class="fw-bold text-dark mb-1">
                            Welcome back,
                            <span class="text-primary">
                                {{ Auth::guard('admin')->user()->name }}
                            </span>
                        </h1>

                        <p class="text-muted mb-0">
                            Here’s what’s happening with your store today.
                        </p>

                    </div>

                    <!-- Right -->
                    <div class="d-flex gap-2">

                        <a href="#" class="btn btn-light border shadow-sm rounded-4 px-4">
                            <i class="bi bi-download me-2"></i>
                            Reports
                        </a>

                        <a href="#" class="btn btn-primary shadow-sm rounded-4 px-4">
                            <i class="bi bi-plus-lg me-2"></i>
                            New View
                        </a>

                    </div>

                </div>

            </div>
        </div>

        <!-- Page Body -->
        <div class="page-body mb-4">
            <div class="container-xl">

                <!-- Row 1: Sales Analytics Cards (Dynamic) -->
                <div class="row row-cards g-3 mb-4">

                    <!-- Card 1: Today Sales -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-primary"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Today's Sales
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            ${{ number_format($sales['day'], 2) }}
                                        </h2>
                                        <div class="d-flex align-items-center text-success small fw-semibold">
                                            <i class="bi bi-calendar-check fs-5 me-1"></i>
                                            Today Performance
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-primary-subtle text-primary">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: This Week Sales -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-success"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            This Week Sales
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            ${{ number_format($sales['week'], 2) }}
                                        </h2>
                                        <div class="d-flex align-items-center text-success small fw-semibold">
                                            <i class="bi bi-calendar-week fs-5 me-1"></i>
                                            Weekly Revenue
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-success-subtle text-success">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: This Month Sales -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-warning"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            This Month Sales
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            ${{ number_format($sales['month'], 2) }}
                                        </h2>
                                        <div class="d-flex align-items-center text-warning small fw-semibold">
                                            <i class="bi bi-calendar-month fs-5 me-1"></i>
                                            Monthly Earnings
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-warning-subtle text-warning">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: This Year Sales -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-danger"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            This Year Sales
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            ${{ number_format($sales['year'], 2) }}
                                        </h2>
                                        <div class="d-flex align-items-center text-danger small fw-semibold">
                                            <i class="bi bi-calendar3 fs-5 me-1"></i>
                                            Annual Total
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-danger-subtle text-danger">
                                        <i class="bi bi-wallet2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Row 2: Product Status Counts Cards (Dynamic) -->
                <div class="row row-cards g-3">

                    <!-- Card 1: Pending Items -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-warning"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Pending Items
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $statusCount['pending'] ?? 0 }}
                                        </h2>
                                        <div class="d-flex align-items-center text-warning small fw-semibold">
                                            <i class="bi bi-clock-history me-1"></i>
                                            Awaiting Review
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-warning-subtle text-warning">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Soft Rejected -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-danger"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Soft Rejected
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $statusCount['soft_rejected'] ?? 0 }}
                                        </h2>
                                        <div class="d-flex align-items-center text-danger small fw-semibold">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            Needs Revision
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-danger-subtle text-danger">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Hard Rejected -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-danger" style="background: linear-gradient(90deg, #7f1d1d, #f87171);">
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Hard Rejected
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $statusCount['hard_rejected'] ?? 0 }}
                                        </h2>
                                        <div class="d-flex align-items-center text-danger small fw-semibold">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Permanently Declined
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-danger-subtle text-danger">
                                        <i class="bi bi-shield-x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Approved Items -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-success"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Approved Items
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $statusCount['approved'] ?? 0 }}
                                        </h2>
                                        <div class="d-flex align-items-center text-success small fw-semibold">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Live on Store
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-success-subtle text-success">
                                        <i class="bi bi-check2-all"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row row-cards g-3 mt-3">

                    <!-- Card 1: Pending KYC -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-primary"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Pending KYC
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $kycCount }}
                                        </h2>
                                        <div class="d-flex align-items-center text-primary small fw-semibold">
                                            <i class="bi bi-file-earmark-text me-1"></i>
                                            Verification Requests
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-primary-subtle text-primary">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Total Orders -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-success"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Total Orders
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $orderCount }}
                                        </h2>
                                        <div class="d-flex align-items-center text-success small fw-semibold">
                                            <i class="bi bi-basket-check me-1"></i>
                                            Completed Purchases
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-success-subtle text-success">
                                        <i class="bi bi-cart3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Pending Withdrawals -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">
                            <div class="card-top-warning"></div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-uppercase text-muted fw-semibold small mb-2">
                                            Pending Withdrawals
                                        </div>
                                        <h2 class="fw-bold mb-1 text-dark">
                                            {{ $withdrawCount }}
                                        </h2>
                                        <div class="d-flex align-items-center text-warning small fw-semibold">
                                            <i class="bi bi-cash-stack me-1"></i>
                                            Awaiting Payout
                                        </div>
                                    </div>
                                    <div class="dashboard-icon bg-warning-subtle text-warning">
                                        <i class="bi bi-wallet2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- Analytics Chart Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                                    <div>
                                        <h4 class="fw-bold text-dark mb-1">Yearly Sales Analytics</h4>
                                        <p class="text-muted small mb-0">Monitor your monthly sales, commissions, and
                                            revenue analytics.</p>
                                    </div>

                                    <!-- Year Filter Form -->
                                    <form method="GET" action="{{ route('admin.dashboard') }}" id="yearForm">
                                        <select name="year" id="yearSelect"
                                            class="form-select form-select-sm rounded-3 px-3 shadow-sm">
                                            @foreach ($years as $y)
                                                <option value="{{ $y->year }}"
                                                    {{ request('year', $chartData['year']) == $y->year ? 'selected' : '' }}>
                                                    {{ $y->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>

                                <!-- Chart Container -->
                                <div id="sales-analytics-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 3: Additional Analytics Cards (KYC, Orders, Withdrawals, Subscribers) -->

            </div>


        </div>

    </div>

    <style>
        .dashboard-card {
            transition: all .25s ease;
            background: #fff;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px rgba(15, 23, 42, .08) !important;
        }

        .card-top-primary,
        .card-top-success,
        .card-top-warning,
        .card-top-danger {
            height: 6px;
        }

        .card-top-primary {
            background: linear-gradient(90deg, #206bc4, #4ea5ff);
        }

        .card-top-success {
            background: linear-gradient(90deg, #16a34a, #4ade80);
        }

        .card-top-warning {
            background: linear-gradient(90deg, #f59e0b, #facc15);
        }

        .card-top-danger {
            background: linear-gradient(90deg, #dc2626, #fb7185);
        }

        .dashboard-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, .4);
        }

        .bg-primary-lt {
            background: rgba(32, 107, 196, .12);
        }
    </style>
@endsection

@push('scripts')
    <!-- ApexCharts Plugin Script -->
    <script src="{{ asset('assets/admin/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Auto submit form on year change
            document.getElementById('yearSelect').addEventListener('change', function() {
                document.getElementById('yearForm').submit();
            });

            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'inherit'
                },
                series: @json($chartData['series']),
                stroke: {
                    width: [0, 0, 3],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                        borderRadius: 6
                    }
                },
                fill: {
                    opacity: [0.85, 0.85, 1],
                },
                colors: ['#206bc4', '#f59f00', '#2fb344'],
                labels: @json($chartData['months']),
                xaxis: {
                    type: 'category',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -10
                }
            };

            const chart = new ApexCharts(document.querySelector("#sales-analytics-chart"), options);
            chart.render();
        });
    </script>
@endpush

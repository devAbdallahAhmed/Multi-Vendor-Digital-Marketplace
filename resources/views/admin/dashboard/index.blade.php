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
                            {{ Auth::user('admin')->name }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0">
                        Here’s what’s happening with your store today.
                    </p>

                </div>

                <!-- Right -->
                <div class="d-flex gap-2">

                    <a href="#"
                       class="btn btn-light border shadow-sm rounded-4 px-4">

                        <i class="bi bi-download me-2"></i>
                        Reports
                    </a>

                    <a href="#"
                       class="btn btn-primary shadow-sm rounded-4 px-4">

                        <i class="bi bi-plus-lg me-2"></i>
                        New View
                    </a>

                </div>

            </div>

        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
        <div class="container-xl">

            <div class="row row-cards">

                <!-- Card -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">

                        <!-- Dark Top -->
                        <div class="card-top-primary"></div>

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <!-- Text -->
                                <div>

                                    <div class="text-uppercase text-muted fw-semibold small mb-2">
                                        Total Leads
                                    </div>

                                    <h2 class="fw-bold mb-1 text-dark">
                                        2,154
                                    </h2>

                                    <div class="d-flex align-items-center text-success small fw-semibold">

                                        <i class="bi bi-arrow-up-short fs-5"></i>

                                        +12% this month

                                    </div>

                                </div>

                                <!-- Icon -->
                                <div class="dashboard-icon bg-primary-subtle text-primary">

                                    <i class="bi bi-people-fill"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Card -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">

                        <div class="card-top-success"></div>

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="text-uppercase text-muted fw-semibold small mb-2">
                                        Revenue
                                    </div>

                                    <h2 class="fw-bold mb-1 text-dark">
                                        $54,200
                                    </h2>

                                    <div class="d-flex align-items-center text-success small fw-semibold">

                                        <i class="bi bi-arrow-up-short fs-5"></i>

                                        +8% growth

                                    </div>

                                </div>

                                <div class="dashboard-icon bg-success-subtle text-success">

                                    <i class="bi bi-cash-stack"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Card -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">

                        <div class="card-top-warning"></div>

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="text-uppercase text-muted fw-semibold small mb-2">
                                        Active Tasks
                                    </div>

                                    <h2 class="fw-bold mb-1 text-dark">
                                        142
                                    </h2>

                                    <div class="d-flex align-items-center text-warning small fw-semibold">

                                        <i class="bi bi-clock-history me-1"></i>

                                        Pending Review

                                    </div>

                                </div>

                                <div class="dashboard-icon bg-warning-subtle text-warning">

                                    <i class="bi bi-check2-square"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Card -->
                <div class="col-sm-6 col-lg-3">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden dashboard-card h-100">

                        <div class="card-top-danger"></div>

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="text-uppercase text-muted fw-semibold small mb-2">
                                        New Orders
                                    </div>

                                    <h2 class="fw-bold mb-1 text-dark">
                                        85
                                    </h2>

                                    <div class="d-flex align-items-center text-danger small fw-semibold">

                                        <i class="bi bi-arrow-down-short fs-5"></i>

                                        -3% this week

                                    </div>

                                </div>

                                <div class="dashboard-icon bg-danger-subtle text-danger">

                                    <i class="bi bi-cart3"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<style>

    /* Cards */

    .dashboard-card{
        transition: all .25s ease;
        background: #fff;
    }

    .dashboard-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 20px 30px rgba(15,23,42,.08) !important;
    }

    /* Top Bar */

    .card-top-primary,
    .card-top-success,
    .card-top-warning,
    .card-top-danger{
        height: 6px;
    }

    .card-top-primary{
        background: linear-gradient(90deg,#206bc4,#4ea5ff);
    }

    .card-top-success{
        background: linear-gradient(90deg,#16a34a,#4ade80);
    }

    .card-top-warning{
        background: linear-gradient(90deg,#f59e0b,#facc15);
    }

    .card-top-danger{
        background: linear-gradient(90deg,#dc2626,#fb7185);
    }

    /* Icon Box */

    .dashboard-icon{
        width: 60px;
        height: 60px;
        border-radius: 18px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 24px;

        box-shadow: inset 0 1px 1px rgba(255,255,255,.4);
    }

    /* Bootstrap Lite Backgrounds */

    .bg-primary-lt{
        background: rgba(32,107,196,.12);
    }

</style>

@endsection

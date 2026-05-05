@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper" style="background: #f8fafc;"> <!-- خلفية فاتحة ومريحة للعين -->
    <!-- Page header -->
    <div class="page-header d-print-none py-4">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- نصوص بلون داكن لتتناسب مع الخلفية الفاتحة -->
                    <h2 class="page-title text-dark fw-bold" style="font-size: 1.5rem;">
                        Dashboard Overview
                    </h2>
                    <p class="text-muted mb-0">Welcome back, <span class="text-primary fw-medium">{{ Auth::user('admin')->name }}</span></p>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn btn-white border-0 shadow-sm rounded-3">
                                New view
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <!-- Stat Card 1 (Total Leads) -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 modern-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-3 bg-primary-lt me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-people text-primary fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted fw-medium small uppercase tracking-wider">Total Leads</div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h2 mb-0 me-2 fw-bold text-dark">2,154</div>
                                        <div class="small text-success fw-medium">
                                            <i class="bi bi-arrow-up-short"></i>12%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 (Revenue) -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 modern-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-3 bg-green-lt me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-currency-dollar text-green fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted fw-medium small uppercase tracking-wider">Revenue</div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h2 mb-0 me-2 fw-bold text-dark">$54,200</div>
                                        <div class="small text-success fw-medium">
                                            <i class="bi bi-arrow-up-short"></i>8%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 (Active Tasks) -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 modern-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-3 bg-orange-lt me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-check2-square text-orange fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted fw-medium small uppercase tracking-wider">Tasks</div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h2 mb-0 me-2 fw-bold text-dark">142</div>
                                        <div class="small text-muted fw-medium">Pending</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 (New Orders) -->
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm border-0 shadow-sm rounded-4 modern-card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-3 bg-purple-lt me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-cart3 text-purple fs-3"></i>
                                </div>
                                <div>
                                    <div class="text-muted fw-medium small uppercase tracking-wider">New Orders</div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h2 mb-0 me-2 fw-bold text-dark">85</div>
                                        <div class="small text-danger fw-medium">
                                            <i class="bi bi-arrow-down-short"></i>3%
                                        </div>
                                    </div>
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
    /* لمسة إضافية للمودرن ديزاين */
    .modern-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background: #ffffff !important;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }

    .bg-primary-lt { background-color: rgba(32, 107, 196, 0.1) !important; }
    .bg-green-lt { background-color: rgba(47, 179, 68, 0.1) !important; }
    .bg-orange-lt { background-color: rgba(247, 103, 7, 0.1) !important; }
    .bg-purple-lt { background-color: rgba(174, 62, 201, 0.1) !important; }

    .uppercase { text-transform: uppercase; }
    .tracking-wider { letter-spacing: 0.05em; }
</style>
@endsection

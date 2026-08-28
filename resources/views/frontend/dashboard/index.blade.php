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
                @can('is_author')
                    <button type="button" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#selectCategoryModal" style="border-radius: 8px;">
                        <i class="ti ti-plus"></i> Add New Item
                    </button>
                @else
                    <a href="{{ url('/') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm"
                        style="border-radius: 8px;">
                        <i class="ti ti-shopping-bag"></i> Browse Marketplace
                    </a>
                @endcan
            </div>
        </div>

        <div class="row g-3">
            <div class="col-xl-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Total Purchases
                                </div>
                                <h4 class="fw-bold mb-0">
                                    {{ $purchaseCount ?? 0 }}
                                </h4>
                            </div>
                            <div class="icon-box bg-primary-subtle text-primary">
                                <i class="ti ti-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Total Reviews
                                </div>
                                <h4 class="fw-bold mb-0">
                                    {{ $reviewCount ?? 0 }}
                                </h4>
                            </div>
                            <div class="icon-box bg-warning-subtle text-warning">
                                <i class="ti ti-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    Total Spend
                                </div>
                                <h4 class="fw-bold mb-0 text-success">
                                    {{ config('settings.site_currency_icon') }}{{ number_format($totalSpend ?? 0, 2) }}
                                </h4>
                            </div>
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="ti ti-cash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('is_author')
            <div class="row g-4 mt-2">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div
                            class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-dark mb-0 fs-6">Recent Items</h5>
                            <a href="{{ route('user.items.index') }}"
                                class="text-decoration-none small fw-semibold text-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-muted small">
                                        <tr>
                                            <th class="py-2 px-4">Item Name</th>
                                            <th class="py-2">Price</th>
                                            <th class="py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $recentItems = \App\Models\Item::where('author_id', auth()->id())
                                                ->latest()
                                                ->take(5)
                                                ->get();
                                        @endphp

                                        @forelse($recentItems as $item)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="fw-bold text-dark small">{{ $item->name }}</div>
                                                    <small class="text-muted"
                                                        style="font-size: 0.75rem;">{{ $item->category?->name ?? 'General' }}</small>
                                                </td>
                                                <td class="py-3 small fw-semibold text-success">
                                                    ${{ $item->discount_price > 0 ? $item->discount_price : $item->price }}
                                                </td>
                                                <td class="py-3">
                                                    @if ($item->status === 'active')
                                                        <span
                                                            class="badge bg-success-subtle text-success rounded-pill px-2 py-1"
                                                            style="font-size: 0.7rem;">Active</span>
                                                    @elseif($item->status === 'pending')
                                                        <span
                                                            class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1"
                                                            style="font-size: 0.7rem;">Pending</span>
                                                    @else
                                                        <span
                                                            class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-1"
                                                            style="font-size: 0.7rem;">{{ ucfirst($item->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4 text-muted small">
                                                    No items uploaded yet. <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#selectCategoryModal">Add your first item</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3 px-4">
                            <h5 class="fw-bold text-dark mb-0 fs-6">Activity Report</h5>
                        </div>
                        <div class="card-body px-4 py-3 d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-box-seam fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Total Uploaded Items</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">All time products</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-dark">
                                    {{ \App\Models\Item::where('author_id', auth()->id())->count() }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-check-circle fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Approved Items</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Live on marketplace</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-success">
                                    {{ \App\Models\Item::where('author_id', auth()->id())->where('status', 'active')->count() }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-hourglass-split fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Pending Review</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Waiting for approval</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-warning">
                                    {{ \App\Models\Item::where('author_id', auth()->id())->where('status', 'pending')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row g-4 mt-2">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div
                            class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-dark mb-0 fs-6">Recent Purchases</h5>
                            <a href="{{ route('orders.index') }}"
                                class="text-decoration-none small fw-semibold text-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-muted small">
                                        <tr>
                                            <th class="py-2 px-4">Purchase ID / Details</th>
                                            <th class="py-2">Amount</th>
                                            <th class="py-2">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $recentPurchases = \App\Models\Purchase::where('user_id', auth()->id())
                                                ->latest()
                                                ->take(5)
                                                ->get();
                                        @endphp

                                        @forelse($recentPurchases as $purchase)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="fw-bold text-dark small">
                                                        #{{ $purchase->id }}</div>
                                                    <small class="text-muted" style="font-size: 0.75rem;">Digital
                                                        Purchase</small>
                                                </td>
                                                <td class="py-3 small fw-semibold text-success">
                                                    ${{ number_format($purchase->total_amount ?? ($purchase->amount ?? 0), 2) }}
                                                </td>
                                                <td class="py-3 small text-muted">
                                                    {{ $purchase->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4 text-muted small">
                                                    No purchases made yet. <a href="{{ url('/') }}">Explore
                                                        marketplace</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-0 py-3 px-4">
                            <h5 class="fw-bold text-dark mb-0 fs-6">Account Activity</h5>
                        </div>
                        <div class="card-body px-4 py-3 d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-bag-check fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Total Orders</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Completed checkouts</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-dark">
                                    {{ $purchaseCount ?? 0 }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-star fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Total Reviews</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Given feedbacks</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-warning">
                                    {{ $reviewCount ?? 0 }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-shield-check fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold small text-dark">Security Status</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">Account protected</small>
                                    </div>
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1"
                                    style="font-size: 0.7rem;">Secure</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

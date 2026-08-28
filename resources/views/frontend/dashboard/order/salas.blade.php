@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">

        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">{{ __('Author Sales') }}</h5>
                <p class="mb-0 text-muted small">{{ __('Track your product sales and earnings.') }}</p>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th class="py-3 px-4 border-0">{{ __('ID') }}</th>
                                <th class="py-3 border-0">{{ __('Product') }}</th>
                                <th class="py-3 border-0">{{ __('Earning') }}</th>
                                <th class="py-3 border-0">{{ __('Platform Charge') }}</th>
                                <th class="py-3 border-0">{{ __('Total') }}</th>
                                <th class="py-3 border-0">{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($sales as $sale)
                                <tr>
                                    <td class="px-4 py-3 fw-medium text-dark">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-3 fw-semibold">
                                        <a href="{{ route('product.details', $sale->item->slug) }}" class="text-decoration-none text-primary" target="_blank">
                                            {{ $sale->item->name }}
                                        </a>
                                    </td>

                                    <td class="py-3 fw-bold text-success" style="font-size: 1.05rem;">
                                        {{ config('settings.currency_icon') }}{{ number_format($sale->author_earning, 2) }}
                                    </td>

                                    <td class="py-3 text-danger fw-semibold">
                                        {{ config('settings.currency_icon') }}{{ number_format($sale->amount - $sale->author_earning, 2) }}
                                    </td>

                                    <td class="py-3 fw-bold text-dark">
                                        {{ config('settings.currency_icon') }}{{ number_format($sale->amount, 2) }}
                                    </td>

                                    <td class="py-3 text-muted small fw-medium">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ $sale->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 border-0">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                                style="width:70px;height:70px;">
                                                <i class="ti ti-report-money fs-2 text-secondary"></i>
                                            </div>
                                            <h5 class="fw-bold mb-1 text-dark">
                                                {{ __('No Sales Found') }}
                                            </h5>
                                            <p class="text-muted mb-0">
                                                {{ __('When your products are purchased, they will appear here.') }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($sales->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $sales->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

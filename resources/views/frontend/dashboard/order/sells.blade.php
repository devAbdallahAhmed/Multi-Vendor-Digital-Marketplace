@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Author Sales') }}</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Earning') }}</th>
                                            <th>{{ __('Platform Charge') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            <th>{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sales as $sale)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="fw-semibold">
                                                    <a href="{{ route('product.details', $sale->item->slug) }}"
                                                        target="_blank">
                                                        {{ $sale->item->name }}
                                                    </a>
                                                </td>
                                                <td class="text-success fw-bold">
                                                    {{ config('settings.currency_icon') }}{{ $sale->author_earning }}
                                                </td>
                                                <td class="text-danger">
                                                    {{ config('settings.currency_icon') }}{{ $sale->amount - $sale->author_earning }}
                                                </td>
                                                <td class="fw-bold">
                                                    {{ config('settings.currency_icon') }}{{ number_format($sale->amount) }}
                                                </td>
                                                <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                            style="width:80px;height:80px;">
                                                            <i class="ti ti-report-money fs-1 text-secondary"></i>
                                                        </div>
                                                        <h5 class="fw-semibold mb-1">{{ __('No Sales Found') }}</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($sales->hasPages())
                            <div class="card-footer d-flex align-items-center">
                                {{ $sales->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

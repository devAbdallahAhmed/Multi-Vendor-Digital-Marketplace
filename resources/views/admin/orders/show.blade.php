@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0">

                        <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title fw-bold mb-0">{{ __('Order Details') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary rounded-3">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Go Back') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive mb-5">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;"><b>{{ __('Order ID') }}</b></td>
                                            <td>#{{ $order->code }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('User') }}</b></td>
                                            <td>{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('Payment Method') }}</b></td>
                                            <td>{{ $order->transaction->payment_gateway }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('Total Amount') }}</b></td>
                                            <td>{{ config('settings.currency_icon') }}{{ $order->transaction->paid_amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('Paid in Amount') }}</b></td>
                                            <td>{{ $order->transaction->paid_in_currency_icon }}
                                                {{ $order->transaction->paid_in_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('Exchange Rate') }}</b></td>
                                            <td>{{ $order->transaction->exchange_rate }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{{ __('Status') }}</b></td>
                                            <td><span
                                                    class="badge bg-success text-white px-2 py-1">{{ ucfirst($order->transaction->status) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 class="card-title fw-bold mb-3">{{ __('Purchased Items') }}</h3>

                            <div class="table-responsive">
                                <table class="table table-vcenter table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 5%">#</th>
                                            <th>{{ __('Product') }}</th>
                                            <th class="text-end" style="width: 15%">{{ __('Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order->purchaseItems as $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                                <td>
                                                    <p class="fw-semibold mb-1">{{ $item->item->name }}</p>
                                                    <div class="text-muted fs-6" style="font-size: 0.85rem;">
                                                        {{ $item->item->author->name ?? '' }}</div>
                                                </td>
                                                <td class="text-end fw-semibold text-dark">
                                                    {{ config('settings.currency_icon') }}{{ $item->price }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="2" class="fw-bold text-end text-uppercase">
                                                {{ __('Total Due') }}</td>
                                            <td class="fw-bold text-end text-success fs-5">
                                                {{ $order->transaction->paid_in_currency_icon }}
                                                {{ $order->transaction->paid_in_amount }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

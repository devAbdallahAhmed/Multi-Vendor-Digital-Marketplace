@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-bottom-0">
                            <h3 class="card-title fw-bold">{{ __('All Orders') }}</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">{{ __('ID') }}</th>
                                        <th scope="col">{{ __('Buyer') }}</th>
                                        <th scope="col">{{ __('Amount') }}</th>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col" class="text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td class="fw-semibold text-muted">#{{ $order->code }}</td>
                                            <td class="fw-medium">{{ $order->user->name ?? __('Unknown') }}</td>
                                            <td>
                                                <span class="text-success fw-bold">
                                                    {{ $order->transaction->paid_in_currency_icon ?? '' }}
                                                    {{ $order->transaction->paid_in_amount ?? 0 }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success text-white px-2 py-1">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"> </i>  {{ __('View') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="empty">
                                                    <div class="empty-img mb-3">
                                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                                    </div>
                                                    <p class="empty-title fw-semibold text-muted fs-5">
                                                        {{ __('No Orders Found') }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

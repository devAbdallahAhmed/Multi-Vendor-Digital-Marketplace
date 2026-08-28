@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">

        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">{{ __('All Transactions') }}</h5>
                <p class="mb-0 text-muted small">{{ __('View and track all your financial transactions.') }}</p>
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
                                <th class="py-3 border-0">{{ __('Transaction ID') }}</th>
                                <th class="py-3 border-0">{{ __('User') }}</th>
                                <th class="py-3 border-0">{{ __('Amount') }}</th>
                                <th class="py-3 border-0">{{ __('Status') }}</th>
                                <th class="py-3 border-0">{{ __('Method') }}</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-3 fw-medium text-dark">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-3 fw-semibold text-dark">
                                        {{ $transaction->payment_id }}
                                    </td>

                                    <td class="py-3">
                                        {{ $transaction->user->name ?? 'N/A' }}
                                    </td>

                                    <td class="py-3 fw-bold text-success" style="font-size: 1.05rem;">
                                        {{ number_format($transaction->amount, 2) }} {{ $transaction->currency_icon }}
                                    </td>

                                    <td class="py-3">
                                        @if ($transaction->status === 'completed')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold border border-success-subtle">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 fw-semibold border border-warning-subtle">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3 text-muted fw-medium">
                                        {{ $transaction->payment_gateway }}
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
                                                {{ __('No Transactions Found') }}
                                            </h5>
                                            <p class="text-muted mb-0">
                                                {{ __('When you make or receive transactions, they will appear here.') }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($transactions->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

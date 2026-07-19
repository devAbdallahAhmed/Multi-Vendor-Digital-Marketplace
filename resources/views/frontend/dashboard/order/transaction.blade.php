@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('All Transactions') }}</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Transaction ID') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Method') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->payment_id }}</td>

                                                <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                                                <td>{{ number_format($transaction->amount, 2) }}
                                                    {{ $transaction->currency_icon }}</td>
                                                <td>
                                                    <span
                                                        class=" text-white badge {{ $transaction->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction->payment_gateway }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                            style="width:80px;height:80px;">
                                                            <i class="ti ti-report-money fs-1 text-secondary"></i>
                                                        </div>
                                                        <h5 class="fw-semibold mb-1">
                                                            {{ __('No Transactions Found') }}
                                                        </h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($transactions->hasPages())
                            <div class="card-footer d-flex align-items-center">
                                {{ $transactions->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

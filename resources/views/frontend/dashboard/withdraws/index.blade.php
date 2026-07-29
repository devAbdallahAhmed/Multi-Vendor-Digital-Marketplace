@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">{{ __('Withdraw History') }}</h4>
                             <a href="{{ route('user.withdraw.create') }}"
                                        class="btn btn-primary btn-md rounded-3 px-4 fw-semibold shadow-sm">
                                        <i class="bi bi-plus-circle-fill me-2"></i>{{ __('Add New Category') }}
                                    </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SN') }}</th>
                                            <th>{{ __('Method') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($withdraws as $withdraw)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="fw-semibold">
                                                    {{ $withdraw->method }}
                                                </td>
                                                <td class="text-success fw-bold">
                                                    {{ config('settings.currency_icon') }}{{ number_format($withdraw->amount, 2) }}
                                                </td>
                                                <td>
                                                    @if ($withdraw->status === 'pending')
                                                        <span
                                                            class="badge bg-warning text-white">{{ __('Pending') }}</span>
                                                    @elseif($withdraw->status === 'paid')
                                                        <span
                                                            class="badge bg-success text-white">{{ __('Paid') }}</span>
                                                    @elseif($withdraw->status === 'rejected')
                                                        <span
                                                            class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $withdraw->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                            style="width:80px;height:80px;">
                                                            <i class="ti ti-receipt-off fs-1 text-secondary"></i>
                                                        </div>
                                                        <h5 class="fw-semibold mb-1">
                                                            {{ __('No withdraw requests found yet') }}</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($withdraws->hasPages())
                            <div class="card-footer d-flex align-items-center">
                                {{ $withdraws->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

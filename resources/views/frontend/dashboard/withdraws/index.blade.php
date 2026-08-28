@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">

        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">{{ __('Withdraw History') }}</h5>
                <p class="mb-0 text-muted small">{{ __('Manage your withdrawals and request new payouts.') }}</p>
            </div>

            <a href="{{ route('user.withdraw.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm fw-medium text-nowrap" style="border-radius: 50px; padding: 8px 20px;">
                <i class="ti ti-plus fs-6"></i> {{ __('Request Withdraw') }}
            </a>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th class="py-3 px-4 border-0">{{ __('SN') }}</th>
                                <th class="py-3 border-0">{{ __('Method') }}</th>
                                <th class="py-3 border-0">{{ __('Amount') }}</th>
                                <th class="py-3 border-0">{{ __('Status') }}</th>
                                <th class="py-3 border-0">{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($withdraws as $withdraw)
                                <tr>
                                    <td class="px-4 py-3 fw-medium text-dark">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-3">
                                        <div class="fw-bold text-dark">
                                            {{ $withdraw->method }}
                                        </div>
                                    </td>

                                    <td class="py-3">
                                        <div class="fw-bold text-success" style="font-size: 1.05rem;">
                                            {{ config('settings.currency_icon', '$') }}{{ number_format($withdraw->amount, 2) }}
                                        </div>
                                    </td>

                                    <td class="py-3">
                                        @if ($withdraw->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 fw-semibold border border-warning-subtle">
                                                {{ __('Pending') }}
                                            </span>
                                        @elseif($withdraw->status === 'paid')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold border border-success-subtle">
                                                {{ __('Paid') }}
                                            </span>
                                        @elseif($withdraw->status === 'rejected')
                                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fw-semibold border border-danger-subtle">
                                                {{ __('Rejected') }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fw-semibold border border-secondary-subtle">
                                                {{ ucfirst($withdraw->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3 text-muted small fw-medium">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ $withdraw->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 border-0">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                                style="width:70px;height:70px;">
                                                <i class="ti ti-receipt-off fs-2 text-secondary"></i>
                                            </div>
                                            <h5 class="fw-bold mb-1 text-dark">
                                                {{ __('No withdraw requests found yet') }}
                                            </h5>
                                            <p class="text-muted mb-0">
                                                {{ __('When you submit a withdrawal request, it will appear here.') }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($withdraws->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                    {{ $withdraws->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

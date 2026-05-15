@extends('admin.layouts.master')

@section('content')

<div class="page-wrapper">

    <div class="page-body">

        <div class="container-xl">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                        <div>

                            <h3 class="fw-bold text-dark mb-1">
                                {{ __('KYC Requests') }}
                            </h3>

                            <p class="text-muted mb-0">
                                {{ __('Manage and review user verification requests') }}
                            </p>

                        </div>

                        <div class="d-flex align-items-center gap-2">

                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">

                                {{ $kycVerification->total() }}

                                {{ __('Requests') }}

                            </span>

                        </div>

                    </div>

                </div>

                <!-- Table -->
                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-4 py-3 fw-semibold text-muted">
                                    {{ __('User') }}
                                </th>

                                <th class="py-3 fw-semibold text-muted">
                                    {{ __('Email') }}
                                </th>

                                <th class="py-3 fw-semibold text-muted">
                                    {{ __('Status') }}
                                </th>

                                <th class="py-3 fw-semibold text-muted">
                                    {{ __('Submitted') }}
                                </th>

                                <th class="py-3 fw-semibold text-center text-muted">
                                    {{ __('Actions') }}
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($kycVerification as $kyc)

                                <tr class="table-row">

                                    <!-- User -->
                                    <td class="ps-4 py-3">

                                        <div class="d-flex align-items-center gap-3">

                                            <div class="user-avatar bg-primary-subtle text-primary">

                                                {{ strtoupper(substr($kyc->user?->name, 0, 1)) }}

                                            </div>

                                            <div>

                                                <h6 class="mb-0 fw-semibold text-dark">

                                                    {{ $kyc->user?->name }}

                                                </h6>

                                                <small class="text-muted">

                                                    {{ __('User ID') }} #{{ $kyc->user?->id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- Email -->
                                    <td class="py-3 text-muted">

                                        {{ $kyc->user?->email }}

                                    </td>

                                    <!-- Status -->
                                    <td class="py-3">

                                        @if($kyc->status === 'approved')

                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">

                                                <i class="bi bi-check-circle-fill me-1"></i>

                                                {{ __('Approved') }}

                                            </span>

                                        @elseif($kyc->status === 'pending')

                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">

                                                <i class="bi bi-clock-history me-1"></i>

                                                {{ __('Pending') }}

                                            </span>

                                        @else

                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">

                                                <i class="bi bi-x-circle-fill me-1"></i>

                                                {{ __('Rejected') }}

                                            </span>

                                        @endif

                                    </td>

                                    <!-- Date -->
                                    <td class="py-3 text-muted">

                                        {{ $kyc->created_at->diffForHumans() }}

                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3 text-center">

                                        <div class="d-flex align-items-center justify-content-center gap-2">

                                            <!-- Show -->
                                            <a href="{{ route('admin.kyc-request.show', $kyc->id) }}"
                                               class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
                                               data-bs-toggle="tooltip"
                                               title="{{ __('View Request') }}">

                                                <i class="bi bi-eye text-primary"></i>

                                            </a>

                                            <!-- Delete -->
                               <form action="{{ route('admin.kyc-request.destroy', $kyc->id) }}"
      method="POST"
      class="m-0 delete-form">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
            data-bs-toggle="tooltip"
            title="{{ __('Delete Request') }}">

        <i class="bi bi-trash3 text-danger"></i>

    </button>

</form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <div class="d-flex flex-column align-items-center">

                                            <div class="empty-icon mb-3">

                                                <i class="bi bi-folder2-open"></i>

                                            </div>

                                            <h5 class="fw-bold text-dark">

                                                {{ __('No KYC Requests Found') }}

                                            </h5>

                                            <p class="text-muted mb-0">

                                                {{ __('There are currently no verification requests.') }}

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- Pagination -->
                @if($kycVerification->hasPages())

                    <div class="card-footer bg-white border-0 py-3">

                        {{ $kycVerification->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

<style>

    .table-row{
        transition: all .2s ease;
    }

    .table-row:hover{
        background: #f8fafc;
    }

    .user-avatar{
        width: 46px;
        height: 46px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 700;
        font-size: 16px;
    }

    .empty-icon{
        width: 70px;
        height: 70px;

        border-radius: 20px;

        background: #f1f5f9;
        color: #64748b;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 30px;
    }

    .action-btn{
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        transition: all .2s ease;
    }

    .action-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,.08);
    }

</style>

@endsection

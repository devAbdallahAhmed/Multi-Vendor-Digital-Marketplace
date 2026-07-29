@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex justify-content-between align-items-start w-100">
                            <div>
                                <h3 class="fw-bold mb-1">
                                    {{ __('Withdraw Request Details') }}
                                </h3>
                            </div>
                            <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-light border rounded-3">
                                <i class="bi bi-arrow-left me-1"></i>
                                {{ __('Go Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th width="220" class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Author Name') }}
                                        </th>
                                        <td class="py-3 fw-bold text-dark">
                                            {{ $withdraw->author->name }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Email') }}
                                        </th>
                                        <td class="py-3">
                                            {{ $withdraw->author->email }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Current Balance') }}
                                        </th>
                                        <td class="py-3 text-success fw-bold">
                                            {{ currencyPosition($withdraw->author->balance) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Withdraw Amount') }}
                                        </th>
                                        <td class="py-3 text-danger fw-bold">
                                            {{ currencyPosition($withdraw->amount) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Payment Method') }}
                                        </th>
                                        <td class="py-3 fw-semibold">
                                            {{ $withdraw->method }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Account Information') }}
                                        </th>
                                        <td class="py-3">
                                            {!! nl2br(e($withdraw->information)) !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Request Date') }}
                                        </th>
                                        <td class="py-3">
                                            {{ $withdraw->created_at->format('Y-m-d') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Current Status') }}
                                        </th>
                                        <td class="py-3">
                                            @if ($withdraw->status === 'paid')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                    {{ __('Paid') }}
                                                </span>
                                            @elseif($withdraw->status === 'pending')
                                                <span
                                                    class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill">
                                                    {{ __('Pending') }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                                    {{ __('Rejected') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Update Status') }}
                                        </th>
                                        <td class="py-3">
                                            <form id="withdrawUpdateForm"
                                                action="{{ route('admin.withdraw-request.update', $withdraw->id) }}"
                                                method="POST" class="d-flex flex-column gap-3 align-items-start">
                                                @csrf
                                                @method('PUT')

                                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                                    <select name="status" id="statusSelect"
                                                        class="form-select w-auto rounded-3"
                                                        {{ $withdraw->status !== 'pending' ? 'disabled' : '' }} required>
                                                        <option value="pending" @selected($withdraw->status === 'pending')>
                                                            {{ __('Pending') }}</option>
                                                        <option value="paid" @selected($withdraw->status === 'paid')>
                                                            {{ __('Paid') }}</option>
                                                        <option value="rejected" @selected($withdraw->status === 'rejected')>
                                                            {{ __('Rejected') }}</option>
                                                    </select>

                                                    <button type="submit" id="submitBtn" class="btn btn-primary rounded-3"
                                                        {{ $withdraw->status !== 'pending' ? 'disabled' : '' }}>
                                                        <span class="spinner-border spinner-border-sm d-none"
                                                            id="btnSpinner"></span>
                                                        <i class="bi bi-check2-circle me-1" id="btnIcon"></i>
                                                        <span id="btnText">{{ __('Update Status') }}</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            const withdrawForm = document.getElementById('withdrawUpdateForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnIcon = document.getElementById('btnIcon');
            const btnText = document.getElementById('btnText');
            const statusSelect = document.getElementById('statusSelect');

            if (withdrawForm) {
                withdrawForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formActionUrl = this.action;
                    const status = statusSelect.value;
                    const token = document.querySelector('input[name="_token"]').value;

                    toggleLoading(true);

                    try {
                        const response = await fetch(formActionUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                _method: 'PUT',
                                status: status
                            })
                        });

                        const contentType = response.headers.get("content-type");
                        let result = {};

                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            result = await response.json();
                        }

                        if (response.ok || response.type === 'opaqueredirect' || response.redirected) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: result.message || 'Status has been updated successfully.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = response.url || window.location.href;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: result.message ||
                                    'An error occurred while updating the status.'
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Something went wrong on our side. Please try again later.'
                        });
                    } finally {
                        toggleLoading(false);
                    }
                });
            }

            function toggleLoading(isLoading) {
                if (!submitBtn) return;
                submitBtn.disabled = isLoading;
                btnSpinner.classList.toggle('d-none', !isLoading);
                btnIcon.classList.toggle('d-none', isLoading);
                btnText.innerText = isLoading ? 'Updating...' : 'Update Status';
            }
        });
    </script>
@endpush

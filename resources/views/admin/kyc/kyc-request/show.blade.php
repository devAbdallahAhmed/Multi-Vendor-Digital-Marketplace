@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header bg-white border-0 p-4">

                        <div class="d-flex justify-content-between align-items-start w-100">

                            <div>

                                <h3 class="fw-bold mb-1">
                                    {{ __('KYC Details') }}
                                </h3>

                                <p class="text-muted mb-0">
                                    {{ __('Review submitted verification information') }}
                                </p>

                            </div>

                            <a href="{{ route('admin.kyc-request.index') }}" class="btn btn-light border rounded-3">

                                <i class="bi bi-arrow-left me-1"></i>

                                {{ __('Go Back') }}

                            </a>

                        </div>

                    </div>
                    {{-- Body --}}
                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <tbody>

                                    {{-- User Name --}}
                                    <tr>
                                        <th width="220" class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('User Name') }}
                                        </th>

                                        <td class="py-3">
                                            {{ $kyc->user?->name }}
                                        </td>
                                    </tr>

                                    {{-- Email --}}
                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Email') }}
                                        </th>

                                        <td class="py-3">
                                            {{ $kyc->user?->email }}
                                        </td>
                                    </tr>

                                    {{-- Document Type --}}
                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Document Type') }}
                                        </th>

                                        <td class="py-3">
                                            {{ strtoupper($kyc->document_type) }}
                                        </td>
                                    </tr>

                                    {{-- Document Number --}}
                                    <tr>
                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Document Number') }}
                                        </th>

                                        <td class="py-3">
                                            {{ $kyc->document_number }}
                                        </td>
                                    </tr>

                                    {{-- Status --}}
                                    <tr>

                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Status') }}
                                        </th>

                                        <td class="py-3">

                                            @if ($kyc->status === 'approved')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                    {{ __('Approved') }}
                                                </span>
                                            @elseif($kyc->status === 'pending')
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

                                    {{-- Attachments --}}
                                    <tr>

                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Attachments') }}
                                        </th>

                                        <td class="py-3">

                                            <div class="d-flex flex-wrap gap-2">

                                                @forelse($attachments as $attachment)
                                                    <a href="{{ route('admin.kyc-request.download-document', [$kyc->id, $loop->index]) }}"
                                                        target="_blank" class="btn btn-light border rounded-3">

                                                        <i class="bi bi-paperclip me-1"></i>

                                                        {{ __('Attachment') }}
                                                        {{ $loop->iteration }}

                                                    </a>

                                                @empty

                                                    <span class="text-muted">
                                                        {{ __('No attachments found') }}
                                                    </span>
                                                @endforelse

                                            </div>

                                        </td>

                                    </tr>

                                    {{-- Update Status --}}
                                    <tr>

                                        <th class="bg-light fw-semibold ps-4 py-3">
                                            {{ __('Action') }}
                                        </th>

                                        <td class="py-3">

                                            <form id="kycUpdateForm" data-id="{{ $kyc->id }}"
                                                class="d-flex align-items-center gap-3 flex-wrap">
                                                @csrf
                                                <select name="status" id="statusSelect"
                                                    class="form-select w-auto rounded-3">
                                                    <option value="pending" @selected($kyc->status === 'pending')>
                                                        {{ __('Pending') }}</option>
                                                    <option value="approved" @selected($kyc->status === 'approved')>
                                                        {{ __('Approved') }}</option>
                                                    <option value="rejected" @selected($kyc->status === 'rejected')>
                                                        {{ __('Rejected') }}</option>
                                                </select>

                                                <button type="submit" id="submitBtn" class="btn btn-primary rounded-3">
                                                    <span class="spinner-border spinner-border-sm d-none"
                                                        id="btnSpinner"></span>
                                                    <i class="bi bi-check2-circle me-1" id="btnIcon"></i>
                                                    <span id="btnText">{{ __('Update Status') }}</span>
                                                </button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kycForm = document.getElementById('kycUpdateForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnSpinner = document.getElementById('btnSpinner');
        const btnIcon = document.getElementById('btnIcon');
        const btnText = document.getElementById('btnText');

        kycForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const kycId = this.dataset.id;
            const status = document.getElementById('statusSelect').value;
            const token = document.querySelector('input[name="_token"]').value;

            // تشغيل حالة التحميل
            toggleLoading(true);

            try {
                const response = await fetch(`/admin/kyc-update-status/${kycId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message || 'Validation Error'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Something went wrong on our side'
                });
            } finally {
                // إيقاف حالة التحميل
                toggleLoading(false);
            }
        });

        function toggleLoading(isLoading) {
            submitBtn.disabled = isLoading;
            btnSpinner.classList.toggle('d-none', !isLoading);
            btnIcon.classList.toggle('d-none', isLoading);
            btnText.innerText = isLoading ? 'Updating...' : 'Update Status';
        }
    });
</script>

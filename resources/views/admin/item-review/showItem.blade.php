@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    {{-- Main Card Container --}}
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        {{-- Header (Title & Back Button) --}}
                        <div class="card-header bg-white border-0 p-4">
                            <div class="d-flex justify-content-between align-items-start w-100">
                                <div>
                                    <h3 class="fw-bold mb-1">
                                        {{ __('Item Review Details') }}
                                    </h3>
                                    <p class="text-muted mb-0">
                                        {{ __('Review item details, history, and update approval status') }}
                                    </p>
                                </div>
                                <a href="{{ route('admin.items.review') }}" class="btn btn-light border rounded-3">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    {{ __('Go Back') }}
                                </a>
                            </div>
                        </div>

                        {{-- Body with Nav Tabs --}}
                        <div class="card-body p-4 ">

                            {{-- Bootstrap 5 / Tabler UI Nav Tabs --}}
                            <ul class="nav nav-tabs mb-3" id="itemReviewTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-semibold" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-content" type="button" role="tab">
                                        {{ __('Item Details') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-semibold" id="history-tab" data-bs-toggle="tab"
                                        data-bs-target="#history-content" type="button" role="tab">
                                        {{ __('History') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link show fw-semibold" id="status-tab" data-bs-toggle="tab"
                                        data-bs-target="#status-content" type="button" role="tab">
                                        {{ __('Status & Action') }}
                                    </button>
                                </li>
                            </ul>
                            <div class="d-flex">
                                {{-- Tab Content Panes --}}
                                <div class="tab-content  col-md-8" id="itemReviewTabsContent">

                                    {{-- Tab 1: Item Details (Accordions) --}}
                                    <div class="tab-pane fade show active" id="details-content" role="tabpanel">
                                        <div class="accordion" id="itemDetailsAccordion">

                                            {{-- 1. Preview --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                                        {{ __('Preview') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body text-center bg-light-lt">
                                                        @if ($item->preview_type === 'image')
                                                            <img src="{{ asset($item->preview_image) }}"
                                                                class="rounded-3 shadow-sm"
                                                                style="max-height: 600px; width: 100%; object-fit: cover;"
                                                                alt="Preview Image">
                                                        @elseif($item->preview_type === 'video')
                                                            <div class="ratio ratio-16x9 mx-auto" style="max-width: 800px;">
                                                                <iframe src="{{ $item->preview_video }}"
                                                                    title="Preview Video" allowfullscreen
                                                                    class="rounded-3 shadow-sm"></iframe>
                                                            </div>
                                                        @elseif($item->preview_type === 'audio')
                                                            <div class="p-4 w-100 d-flex justify-content-center">
                                                                <audio controls class="w-100" style="max-width: 600px;">
                                                                    <source src="{{ asset($item->preview_audio) }}"
                                                                        type="audio/mpeg">
                                                                    {{ __('Your browser does not support the audio element.') }}
                                                                </audio>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="text-muted">{{ __('No preview available for this item.') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 2. Screenshots --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                                        {{ __('Screenshots') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body bg-light-lt">
                                                        @if (!empty($item->screenshots) && count($item->screenshots) > 0)
                                                            <div id="carousel-controls" class="carousel slide"
                                                                data-bs-ride="carousel"
                                                                style="max-width: 800px; margin: 0 auto;">
                                                                <div class="carousel-inner rounded-3 shadow-sm">
                                                                    @foreach ($item->screenshots as $screenshot)
                                                                        <div
                                                                            class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                            <img class="d-block w-100"
                                                                                style="max-height: 500px; object-fit: cover;"
                                                                                alt="Screenshot"
                                                                                src="{{ asset($screenshot) }}" />
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carousel-controls"
                                                                    role="button" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carousel-controls"
                                                                    role="button" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="text-center py-3 text-muted">
                                                                {{ __('No screenshots uploaded for this item.') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 3. Description --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                                        {{ __('Description') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body line-height-md text-secondary">
                                                        @if (!empty($item->description))
                                                            {!! $item->description !!}
                                                        @else
                                                            <span
                                                                class="text-muted">{{ __('No description provided for this item.') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 4. Support --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button collapsed fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                                        {{ __('Support') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body">
                                                        @if ($item->is_supported == 1)
                                                            <span
                                                                class="badge bg-success text-white px-3 py-2 rounded-2 fw-semibold">
                                                                <i class="bi bi-patch-check-fill me-1"></i>
                                                                {{ __('Supported') }}
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white px-3 py-2 rounded-2 fw-semibold">
                                                                <i class="bi bi-patch-exclamation-fill me-1"></i>
                                                                {{ __('Not Supported') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 5. Price --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                                        {{ __('Price') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <x-admin.input-text label="{{ __('Regular Price') }}"
                                                                    name="price" value="{{ $item->price ?? '0.00' }}"
                                                                    disabled />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <x-admin.input-text label="{{ __('Discount Price') }}"
                                                                    name="discount_price"
                                                                    value="{{ $item->discount_price ?? '' }}" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 6. Free Item --}}
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSix">
                                                    <button class="accordion-button collapsed fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                                        {{ __('Free Item') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseSix" class="accordion-collapse collapse"
                                                    data-bs-parent="#itemDetailsAccordion">
                                                    <div class="accordion-body">
                                                        @if ($item->is_free == 1)
                                                            <span
                                                                class="badge bg-success text-white px-3 py-2 rounded-2 fw-semibold">
                                                                {{ __('Free Item') }}
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-secondary text-white px-3 py-2 rounded-2 fw-semibold">
                                                                {{ __('Not Free') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Tab 2: History Logs --}}
                                    <div class="tab-pane fade" id="history-content" role="tabpanel">
                                        <div class="card border border-light shadow-none rounded-3">
                                            <div class="card-body p-4">
                                                @forelse($item->histories as $history)
                                                    <div class="mb-4 last-mb-0 border-bottom pb-3 last-border-0">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <h4 class="fw-bold text-dark mb-0 fs-3">
                                                                {{ $history->title ?? __('No Title') }}
                                                            </h4>
                                                            <span class="badge bg-primary-lt px-2 py-1 rounded-2">
                                                                {{ $history->status ?? '' }}
                                                            </span>
                                                        </div>
                                                        <div class="text-muted small mb-2">
                                                            <i class="bi bi-calendar3 me-1"></i>
                                                            {{ $history->created_at?->format('Y-m-d H:i') }}
                                                        </div>
                                                        <p class="text-secondary mb-0 line-height-sm">
                                                            {{ $history->description ?? __('No additional information.') }}
                                                        </p>
                                                    </div>
                                                @empty
                                                    <div class="text-center py-4 text-muted">
                                                        <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                                                        {{ __('No history logs available for this item.') }}
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tab 3: Status Action & Form --}}
                                    <div class="tab-pane fade" id="status-content" role="tabpanel">
                                        <div class="p-3 border rounded-3 bg-white">

                                            @php
                                                $isSuperAdmin = Auth::guard('admin')->user()->hasRole('superadmin');
                                                $canModify = $isSuperAdmin || $item->status === 'pending';
                                            @endphp

                                            @if ($canModify)
                                                <h4 class="fw-bold mb-3 text-secondary">
                                                    {{ __('Update Item Review Status') }}
                                                </h4>

                                                <form action="{{ route('admin.item.review.status', $item->id) }}"
                                                    method="POST" class="d-flex flex-column gap-3 align-items-start">
                                                    @csrf

                                                    <div class="d-flex align-items-center gap-3 flex-wrap">
                                                        <x-admin.input-select label="Select Status" name="status"
                                                            id="statusSelect" class="form-select w-auto rounded-3">
                                                            <option value="pending" @selected($item->status === 'pending')>
                                                                {{ __('Pending') }}</option>
                                                            <option value="approved" @selected($item->status === 'active')>
                                                                {{ __('Approved') }}</option>
                                                            <option value="soft_reject" @selected($item->status === 'inactive')>
                                                                {{ __('Soft Reject') }}</option>
                                                            <option value="hard_reject" @selected($item->status === 'inactive')>
                                                                {{ __('Hard Reject') }}</option>
                                                        </x-admin.input-select>


                                                        <button
                                                            class="btn btn-primary rounded-3">{{ __('Update Status') }}</button>
                                                    </div>

                                                    <div id="reasonContainer" class="w-100 d-none"
                                                        style="max-width: 500px;">
                                                        <x-admin.input-textarea
                                                            label="{{ __('Rejection / Feedback Reason') }}"
                                                            name="reason" id="rejectReason"
                                                            placeholder="{{ __('Write feedback or reasons for reject...') }}" />
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-important alert-info aria-solid rounded-3 m-0">
                                                    <div class="d-flex">
                                                        <div>
                                                            <i class="bi bi-info-circle me-2 fs-3"></i>
                                                        </div>
                                                        <div>
                                                            <h4 class="alert-title fw-bold">{{ __('Action Disabled') }}
                                                            </h4>
                                                            <div class="text-secondary">
                                                                {{ __('This item has already been processed and updated. You do not have permission to modify its status again unless the author resubmits it.') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm mb-4"
                                        style="border-radius: 12px; position: sticky; top: 20px;">

                                        <!-- Item Info  -->
                                        @include('frontend.dashboard.layouts.partials.Item-Info')

                                    </div>
                                </div>
                            </div>
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
            const form = document.getElementById('itemReviewUpdateForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnIcon = document.getElementById('btnIcon');
            const btnText = document.getElementById('btnText');

            const statusSelect = document.getElementById('statusSelect');
            const reasonContainer = document.getElementById('reasonContainer');
            const rejectReason = document.getElementById('rejectReason');

            function handleStatusChange() {
                if (statusSelect.value === 'soft_reject' || statusSelect.value === 'hard_reject') {
                    reasonContainer.classList.remove('d-none');
                } else {
                    reasonContainer.classList.add('d-none');
                    rejectReason.value = '';
                }
            }

            statusSelect.addEventListener('change', handleStatusChange);
            handleStatusChange();

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const itemId = this.dataset.id;
                const status = statusSelect.value;
                const reason = rejectReason.value;
                const token = document.querySelector('input[name="_token"]').value;

                toggleLoading(true);

                try {
                    const response = await fetch(`/admin/items-review/update-status/${itemId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status: status,
                            reason: reason
                        })
                    });

                    const result = await response.json();

                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated!',
                            text: result.message ||
                                'Item status has been modified successfully.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.message || 'Validation Error occurred.'
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Something went wrong during processing.'
                    });
                } finally {
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

        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('statusSelect');
            const reasonContainer = document.getElementById('reasonContainer');

            if (statusSelect) {
                const checkStatus = () => {
                    const value = statusSelect.value;
                    if (value === 'soft_reject' || value === 'hard_reject') {
                        reasonContainer.classList.remove('d-none');
                    } else {
                        reasonContainer.classList.add('d-none');
                    }
                };

                statusSelect.addEventListener('change', checkStatus);
                checkStatus();
            }
        });
    </script>
@endpush

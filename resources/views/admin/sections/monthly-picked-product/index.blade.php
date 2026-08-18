@extends('admin.layouts.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dee2e6 !important;
            border-radius: 8px !important;
            padding: 6px 10px !important;
            min-height: 48px !important;
            background-color: #f8f9fa !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #206bc4 !important;
            box-shadow: 0 0 0 3px rgba(32, 107, 196, 0.1) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            color: #1e293b !important;
            padding: 4px 8px 4px 24px !important;
            margin-top: 6px !important;
            margin-right: 6px !important;
            position: relative;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            position: absolute !important;
            left: 6px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            color: #64748b !important;
            background: transparent !important;
            border: none !important;
            font-size: 14px !important;
            padding: 0 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #d63939 !important;
            background: transparent !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Update Monthly Picked Products') }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <form action="{{ route('admin.monthly-picked-product-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                          <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="title" label="{{ __('Section Title') }}"
                                                    value="{{ old('title', $monthlyPickedSection->title ?? '') }}"
                                                    placeholder="e.g. Recently Arrived New Items" />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('The main headline of the highlighted products section.') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="content"
                                                    label="{{ __('Content / Description') }}"
                                                    value="{{ old('content', $monthlyPickedSection->content ?? '') }}"
                                                    rows="4"
                                                    placeholder="Every month we pick some best products for you..." />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('The description text that will appear in the monthly picks section.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <div class="form-group mb-0">
                                                    <label class="form-label fw-semibold">{{ __('Select Monthly Items') }}</label>
                                                    <select name="item_ids[]" class="form-control item-select" multiple="multiple">
                                                        @if(isset($selectedItems) && $selectedItems->isNotEmpty())
                                                            @foreach ($selectedItems as $item)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('item_ids')
                                                        <span class="text-danger mt-2 d-block">{{ $message }}</span>
                                                    @enderror
                                                    <small class="text-muted d-block mt-2">
                                                        {{ __('Search and select the products you want to feature this month.') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <div class="text-muted small">
                                            <i class="bi bi-shield-lock me-1"></i>
                                            {{ __('Only administrators can update this section.') }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">
                                                {{ __('Cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary rounded-3 px-4" style="background-color: #206bc4; border: none;">
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ __('Save Changes') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.item-select').select2({
                placeholder: "{{ __('Search for products...') }}",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ route('admin.ajax.product-search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results,
                            pagination: data.pagination
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush

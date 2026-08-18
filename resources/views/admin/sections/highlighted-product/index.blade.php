@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Update Highlighted Products Section') }}</h3>
                        </div>
                        <div class="card-body p-0">

                            <form action="{{ route('admin.highlighted-product-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="title" label="{{ __('Section Title') }}"
                                                    value="{{ old('title', $highlightedSection->title ?? '') }}"
                                                    placeholder="e.g. Recently Arrived New Items" />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('The main headline of the highlighted products section.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="subtitle"
                                                    label="{{ __('Subtitle / Description') }}"
                                                    value="{{ old('subtitle', $highlightedSection->subtitle ?? '') }}"
                                                    rows="3"
                                                    placeholder="e.g. Discover our most premium and trending assets..." />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('A short description below the main title.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <div class="form-group mb-0">
                                                    <label
                                                        class="form-label fw-semibold">{{ __('Select Highlighted Products') }}</label>
                                                    <select name="item_ids[]" class="form-control item-select"
                                                        multiple="multiple">
                                                        @if (isset($selectedItems) && $selectedItems->isNotEmpty())
                                                            @foreach ($selectedItems as $item)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-muted d-block mt-2">
                                                        {{ __('Search and select the products you want to highlight in this section.') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3"
                                    style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <div class="text-muted small">
                                            <i class="bi bi-shield-lock me-1"></i>
                                            {{ __('Only administrators can update the highlighted products section.') }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">
                                                {{ __('Cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary rounded-3 px-4"
                                                style="background-color: #206bc4; border: none;">
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
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
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

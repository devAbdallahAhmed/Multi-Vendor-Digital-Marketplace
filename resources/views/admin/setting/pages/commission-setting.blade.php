@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Account Settings') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        @include('admin.setting.pages.side-setting')
        <!-- END PAGE BODY -->
        <div class="col-12 col-md-9 d-flex flex-column">
            <div class="card shadow-sm border-0 rounded-3">

                {{-- Header --}}
                <div class="card-header bg-white border-bottom py-3 px-4">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:45px; height:45px; background: rgba(13,110,253,.1);">

                            <i class="bi bi-gear-fill text-primary fs-5"></i>

                        </div>

                        <div>

                            <h3 class="card-title mb-0 fw-bold">
                                {{ __('Commission Settings') }}
                            </h3>

                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <form action="{{ route('admin.commission.setting.update') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- Site Name --}}
                            <div class="col-md-12">

                                <div class="border rounded-3 p-3 bg-light">

                                    <x-admin.input-text name="author_commission" label="{{ __('Author Commission (%) ') }}"
                                        value="{{ config('settings.author_commission') }}"
                                        placeholder="e.g. My Digital Market" />

                                    <small class="text-muted d-block mt-2">
                                        {{ __('This name will appear across the marketplace.') }}
                                    </small>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary rounded-3 px-4">

                                <i class="bi bi-check-circle me-1"></i>

                                {{ __('Save Settings') }}

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

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var selects = document.querySelectorAll(".tom-select-class");

            selects.forEach(function(selectElement) {
                new TomSelect(selectElement, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });
        });
    </script>
@endpush

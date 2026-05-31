@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/ez-icon-picker.css') }}">
    <style>
        .easy_container,
        .easy_main {
            max-width: 320px !important;
        }

        .easy_main input[type="text"] {
            width: 320px !important;
        }

        .tagify {
            --tags-border-color: #dadcde;
            --tags-hover-border-color: #b6b9bc;
            --tags-focus-border-color: #206bc4;
            border-radius: 4px;
            padding: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Create New Category') }}</h3>
                            <div class="card-actions">
                                <a href="#" class="btn btn-secondary">
                                    <span><i class="ti ti-arrow-back-up"></i></span>
                                    {{ __('Back to Categories') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.categories.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 ">
                                 <x-admin.input-icon :label="__('Icon')"  name="icon" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="name" label="{{ __('Category Name') }}"
                                            placeholder="{{ __('e.g. Graphics Design, Audio') }}" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="file_types" id="file_types"
                                            label="{{ __('Supported File Types') }}"
                                            placeholder="{{ __('Type extension and press Enter or Comma') }}"
                                            hint="{{ __('The allowed extensions for main files, separated by commas or enter.') }}" />
                                    </div>
                                </div>

                                <div class="card-footer text-end bg-transparent px-0 pb-0 mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <span><i class="ti ti-device-floppy"></i></span>
                                        {{ __('Save Category') }}
                                    </button>
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
    <script src="{{ asset('assets/admin/js/ez-icon-picker.iife.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new EzIconPicker({
                selector: '.icon-picker'
            });

            const input = document.getElementById('file_types');
            if (input && typeof Tagify !== 'undefined') {
                new Tagify(input, {
                    delimiters: ",| ",
                    trim: true
                });
            }
        });
    </script>
@endpush

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
                            <h3 class="card-title">{{ __(' Update Category') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    <span><i class="ti ti-arrow-back-up"></i></span>
                                    {{ __('Back to Categories') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <x-admin.input-icon :label="__('Icon')" name="icon" :value="old('icon', $category->icon)" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="name" label="{{ __('Category Name') }}"
                                            placeholder="{{ __('e.g. Graphics Design, Audio') }}" :value="old('name', $category->name)" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="file_types" id="file_types" :value="old('file_types', $category->file_types)"
                                            label="{{ __('Supported File Types') }}"
                                            placeholder="{{ __('Type extension and press Enter or Comma') }}"
                                            hint="{{ __('The allowed files to be uploaded as main file. e.g. ZIP, JPG, MP4, MP3, PNG, etc.') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <x-admin.label-check name="show_at_nav" :label="__('Show At Nav')" :checked="$category->show_at_nav" />
                                    </div>

                                    <div class="col-md-4">
                                        <x-admin.label-check name="show_at_featured" :label="__('Show At Featured')" :checked="$category->show_at_featured" />
                                    </div>
                                </div>

                                <div class="card-footer text-end bg-transparent px-0 pb-0 mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <span><i class="ti ti-device-floppy"></i></span>
                                        {{ __('Update Category') }}
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

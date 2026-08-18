@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Banner 1') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banner-section.update', 1) }}" method="POST"
                            enctype="multipart/form-data" class="x-form-1">
                            @csrf
                            @method('PUT')

                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Banner Background 1') }}</label>
                                        <input type="file" name="banner_image_1" class="form-control">
                                        @if (isset($bannerSection) && $bannerSection->banner_image_1)
                                            <img src="{{ asset($bannerSection->banner_image_1) }}" width="150"
                                                class="mt-2 rounded">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="banner_title_1" label="{{ __('Title 1') }}"
                                        value="{{ old('banner_title_1', $bannerSection->banner_title_1 ?? '') }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="banner_subtitle_1" label="{{ __('Subtitle 1') }}"
                                        value="{{ old('banner_subtitle_1', $bannerSection->banner_subtitle_1 ?? '') }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="button_text_1" label="{{ __('Button Text 1') }}"
                                        value="{{ old('button_text_1', $bannerSection->button_text_1 ?? '') }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="button_url_1" label="{{ __('Button URL 1') }}"
                                        value="{{ old('button_url_1', $bannerSection->button_url_1 ?? '') }}" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update Banner 1') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Banner 2') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banner-section.update', 1) }}" method="POST"
                            enctype="multipart/form-data" class="x-form-2">
                            @csrf
                            @method('PUT')

                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Banner Background 2') }}</label>
                                        <input type="file" name="banner_image_2" class="form-control">
                                        @if (isset($bannerSection) && $bannerSection->banner_image_2)
                                            <img src="{{ asset($bannerSection->banner_image_2) }}" width="150"
                                                class="mt-2 rounded">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="banner_title_2" label="{{ __('Title 2') }}"
                                        value="{{ old('banner_title_2', $bannerSection->banner_title_2 ?? '') }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="banner_subtitle_2" label="{{ __('Subtitle 2') }}"
                                        value="{{ old('banner_subtitle_2', $bannerSection->banner_subtitle_2 ?? '') }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="button_text_2" label="{{ __('Button Text 2') }}"
                                        value="{{ old('button_text_2', $bannerSection->button_text_2 ?? '') }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="button_url_2" label="{{ __('Button URL 2') }}"
                                        value="{{ old('button_url_2', $bannerSection->button_url_2 ?? '') }}" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update Banner 2') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

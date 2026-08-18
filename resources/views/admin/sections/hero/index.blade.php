@extends('admin.layouts.master')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <style>
        .tagify {
            --tags-border-color: #e6e8eb;
            --tags-hover-border-color: #e6e8eb;
            --tags-focus-border-color: #206bc4;
            border-radius: 4px;
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
                            <h3 class="card-title">{{ __('Update Hero Section') }}</h3>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.hero-section.update', $hero->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="badge" label="{{ __('Badge Text') }}"
                                                    value="{{ old('badge', $hero->badge) }}"
                                                    placeholder="e.g. 10,000+ hand-curated digital assets" />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('Small highlighted text above the main title.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="title" label="{{ __('Main Title') }}"
                                                    value="{{ old('title', $hero->title) }}"
                                                    placeholder="e.g. Discover premium digital assets" />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('The main headline of the hero section. You can use HTML tags like <br> or <span>.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="subtitle"
                                                    label="{{ __('Subtitle / Description') }}"
                                                    value="{{ old('subtitle', $hero->subtitle) }}" rows="3"
                                                    placeholder="e.g. WordPress themes, PHP scripts, HTML templates..." />
                                                <small class="text-muted d-block mt-2">
                                                    {{ __('A short description below the main title.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <div class="form-group mb-0">
                                                    <label class="form-label">{{ __('Trending Tags') }}</label>
                                                    @php
                                                        $trendingTagsValue = is_array($hero->trending_tags)
                                                            ? implode(',', $hero->trending_tags)
                                                            : $hero->trending_tags;
                                                    @endphp
                                                    <input type="text" name="trending_tags" id="my_tags_input"
                                                        class="form-control"
                                                        value="{{ old('trending_tags', $trendingTagsValue) }}"
                                                        placeholder="e.g. PHP Scripts, Laravel Themes, UI Kits">
                                                    <small class="text-muted d-block mt-2">
                                                        {{ __('Separate each tag with a comma (,). These will appear below the search bar.') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <div class="text-muted small">
                                            <i class="bi bi-shield-lock me-1"></i>
                                            {{ __('Only administrators can update the hero section.') }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">
                                                {{ __('Cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary rounded-3 px-4">
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
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.querySelector('#my_tags_input');
            if (input) {
                new Tagify(input);
            }
        });
    </script>

    <script src="{{ asset('assets/front/js/default/fileupload.js') }}"></script>
@endpush

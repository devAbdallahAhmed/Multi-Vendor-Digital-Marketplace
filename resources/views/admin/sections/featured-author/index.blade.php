@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Update Featured Author Section') }}</h3>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('admin.featured-author-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="title" label="{{ __('Section Title') }}"
                                                    value="{{ old('title', $featuredAuthor->title ?? '') }}"
                                                    placeholder="e.g. Featured Author of the Month" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="subtitle"
                                                    label="{{ __('Subtitle / Description') }}"
                                                    value="{{ old('subtitle', $featuredAuthor->subtitle ?? '') }}"
                                                    placeholder="e.g. Discover the best digital products from our top creator." />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <div class="form-group mb-0">
                                                    <label
                                                        class="form-label fw-semibold">{{ __('Select Featured Author') }}</label>
                                                    <select name="author" class="form-control form-select">
                                                        <option value="" disabled
                                                            {{ !isset($featuredAuthor) ? 'selected' : '' }}>
                                                            {{ __('Select an Author') }}
                                                        </option>
                                                        @foreach ($authors as $author)
                                                            <option value="{{ $author->id }}"
                                                                {{ old('author', $featuredAuthor->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                                                {{ $author->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('author')
                                                        <span class="text-danger mt-2 d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3"
                                    style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <div class="text-muted small">
                                            <i class="ti ti-shield-lock me-1"></i>
                                            {{ __('Only administrators can update this section.') }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">
                                                {{ __('Cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                                <i class="ti ti-device-floppy me-1"></i>
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

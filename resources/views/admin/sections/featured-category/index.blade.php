@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper py-4">
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-12">

                        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                                <h3 class="card-title fw-bold text-dark mb-0">{{ __('Featured Categories Management') }}</h3>
                                <p class="text-muted small mb-0">
                                    --{{ __('Select categories to display on the homepage featured section.') }}</p>
                            </div>

                            <div class="card-body p-4">
                                <form action="{{ route('admin.featured-category.update', 1) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <x-admin.input-select multiple="multiple" name="categories[]" :label="__('Featured Categories')"
                                            class="select2">
                                            @foreach ($categories as $feCategory)
                                                <optgroup class="fw-bold text-primary" label="{{ $feCategory->name }}">
                                                    @foreach ($feCategory->subCategories as $subCategory)
                                                        <option @selected(in_array($subCategory->id, $featuredCategories?->category_ids ?? [])) value="{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </x-admin.input-select>
                                    </div>

                                    <div class="d-flex justify-content-end border-top pt-3">
                                        <button type="submit"
                                            class="btn btn-primary px-4 py-2 fw-semibold d-flex align-items-center gap-2 shadow-sm"
                                            style="background-color: #0061ff; border: none; border-radius: 8px;">
                                            <i class="ti ti-device-floppy fs-5"></i>
                                            {{ __('Save Changes') }}
                                        </button>
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

@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __(' Update Sub Category') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    <span><i class="ti ti-arrow-back-up"></i></span>
                                    {{ __('Back to Categories') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.sub-categories.update', $sub_category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="name" label="{{ __('Category Name') }}"
                                            placeholder="{{ __('e.g. Graphics Design, Audio') }}" :value="old('name', $sub_category->name)" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-select name="category_id" :label="__('Parent Category')">
                                            <option value="">{{ __('Select Parent Category') }}</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}" @selected($sub_category->category?->name)>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </x-admin.input-select>
                                    </div>

                                </div>

                                <div class="card-footer text-end bg-transparent px-0 pb-0 mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <span><i class="ti ti-device-floppy"></i></span>
                                        {{ __('Update Sub Category') }}
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

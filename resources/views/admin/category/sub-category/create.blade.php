@extends('admin.layouts.master')


@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Create New Sub Category') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">
                                    <span><i class="ti ti-arrow-back-up"></i></span>
                                    {{ __('Back to Categories') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.sub-categories.store') }}" method="POST">
                                @csrf

                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-text name="name" label="{{ __('Sub Category Name') }}"
                                            placeholder="{{ __('e.g. Graphics Design, Audio') }}" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <x-admin.input-select name="category_id" :label="__('Parent Category')">
                                            <option value="">{{ __('Select Parent Category') }}</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </x-admin.input-select>
                                    </div>
                                </div>

                                <div class="card-footer text-end bg-transparent px-0 pb-0 mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <span><i class="ti ti-device-floppy"></i></span>
                                        {{ __('Save Sub Category') }}
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

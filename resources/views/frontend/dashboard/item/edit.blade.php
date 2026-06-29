@extends('frontend.dashboard.layouts.master')

@push('styles')
    @vite('resources/css/products/create.css')
@endpush

@section('content')
    <div class="page-wrapper py-4">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">{{ __('Update Item') }}</h4>
                            <p class="text-muted mb-0">{{ __('Modify the details below to update your digital asset.') }}</p>
                        </div>
                        <a href="{{ route('user.items.index') }}"
                            class="btn btn-primary d-flex align-items-center gap-2 text-white" style="border-radius: 8px;">
                            {{ __('Back To Items') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-end icon-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M13 18l6 -6" />
                                <path d="M13 6l6 6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <form action="{{ route('user.items.update', $item->id) }}" method="POST" id="product_form">
                @csrf
                @method('PUT')

                <ul class="nav nav-pills mt-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('user.items.edit', $item->id) }}">Edit
                            Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.item.changelog', $item->id) }}">ChangLog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('user.item.history', $item->id) }}">History</a>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Name And Description') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <x-frontend.input-text name="name" label="{{ __('Name') }}" required
                                            :value="$item->name" />
                                    </div>
                                    <div class="col-md-12">
                                        <x-frontend.textarea id="editor" name="description"
                                            label="{{ __('Description') }}" :value="$item->description" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Category And Attributes') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <x-frontend.input-text type="text" name="category_view"
                                            value="{{ $item->category->name }}" label="{{ __('Category') }}"
                                            disabled="true" />
                                        <input type="hidden" name="category" value="{{ $item->category_id }}">
                                    </div>

                                    <div class="col-md-6">
                                        <x-frontend.input-text type="text" name="sub_category_view"
                                            value="{{ $item->sub_category->name }}" label="{{ __('Sub Category') }}"
                                            disabled="true" />
                                        <input type="hidden" name="sub_category" value="{{ $item->sub_category->id }}">
                                    </div>

                                    <div class="col-md-6">
                                        <x-frontend.input-text name="version" label="{{ __('Version') }}"
                                            :value="$item->version" />
                                    </div>

                                    <div class="col-md-6">
                                        <x-frontend.input-text name="demo_link" label="{{ __('Demo Link (Optional)') }}"
                                            :value="$item->demo_link ?? null" />
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="my_tags_input" class="form-label fw-semibold text-secondary mb-2">
                                                {{ __('Search Tags') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="tags[]" id="my_tags_input" class="form-control"
                                                required placeholder="{{ __('Type a tag and press Enter') }}"
                                                value="{{ is_array($item->tags) ? implode(',', $item->tags) : $item->tags }}">
                                            <small
                                                class="text-muted d-block mt-1">{{ __('Tags help customers find your items through search.') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Files') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="dropzone-custom-wrapper mt-4" id="fileUpload"
                                            data-url="{{ route('user.items.uploads') }}"
                                            data-token="{{ csrf_token() }}">
                                            <div class="text-center" style="pointer-events: none;">
                                                <div class="mb-2 file-text-wrapper">
                                                    <i class="bi bi-plus add-file-icon"></i>
                                                    <span class="add-file-text">{{ __('File Upload') }}</span>
                                                </div>
                                                <p class="text-muted mt-2">{{ __('Drop files here or click to upload') }}
                                                </p>
                                            </div>
                                        </div>
                                        <ul class="list-group mt-3" id="fileList">
                                            @foreach ($uploadFiles as $file)
                                                <li class="list-group-item file-list-item d-flex align-items-center justify-content-between"
                                                    id="file-{{ $file->id }}">
                                                    <div class="w-100">
                                                        <div class="d-flex align-items-center">
                                                            <i
                                                                class="bi {{ getIcon($file->mime_type) }} fs-3 me-3 text-primary"></i>
                                                            <span>{{ $file->name }}<span
                                                                    class="file-size">{{ format_size($file->size) }}</span></span>
                                                        </div>
                                                        <div class="progress me-3" style="width:100%; height: 5px;">
                                                            <div class="progress-bar progress-bar-striped bg-success"
                                                                role="progressbar" style="width: 100%;"></div>
                                                        </div>
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm justify-content-end ms-3"
                                                        onclick="removeFile('{{ $file->id }}')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-md-6">
                                        <x-frontend.input-select name="preview_type" label="{{ __('Preview Type') }}"
                                            :value="$item->preview_type">
                                            <option value="image">{{ __('Image') }}</option>
                                            <option value="video">{{ __('Video') }}</option>
                                            <option value="audio">{{ __('Audio') }}</option>
                                        </x-frontend.input-select>
                                    </div>

                                    <div class="col-md-6">
                                        <x-frontend.input-select name="preview_file" label="{{ __('Preview File') }}">
                                            <option value="" id="preview_file_input" disabled>
                                                {{ __('Select File') }}</option>

                                            @foreach ($uploadFiles as $file)
                                                <option value="{{ $file->path }}"
                                                    {{ $item->preview_image == $file->path ? 'selected' : '' }}>
                                                    {{ $file->name }}
                                                </option>
                                            @endforeach
                                        </x-frontend.input-select>
                                    </div>

                                    <div class="col-md-12">
                                        <label
                                            class="form-label mb-2 font-18 font-heading fw-600">{{ __('Main File') }}</label>
                                        <div class="input-group mb-3">
                                            <select name="source_type" class="form-select" id="main_resource_select">
                                                <option value="" selected disabled>{{ __('Select') }}</option>
                                                <option value="upload">{{ __('Upload') }}</option>
                                                <option value="link">{{ __('Link') }}</option>
                                            </select>
                                            <select name="upload_source" class="form-select d-none" id="upload_source">
                                                @foreach ($uploadFiles as $file)
                                                    <option value="{{ $file->path }}">{{ $file->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="link_source" class="form-control d-none"
                                                id="link_source">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <x-frontend.input-select name="screenshots[]" class="select_2" :label="__('Screenshots')"
                                            multiple="multiple" id="screenshot_input">
                                            @foreach ($uploadFiles as $file)
                                                <option value="{{ $file->path }}">{{ $file->name }}</option>
                                            @endforeach
                                        </x-frontend.input-select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Support') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <x-frontend.input-select name="support" id="option_support"
                                            label="{{ __('Item Will Be Supported') }}">
                                            <option value="" disabled>{{ __('Select') }}</option>
                                            <option @selected($item->support == 1) value="1">{{ __('Yes') }}
                                            </option>
                                            <option @selected($item->support == 0) value="0">{{ __('No') }}
                                            </option>
                                        </x-frontend.input-select>
                                    </div>
                                    <div class="col-md-12 d-none" id="support_instruction">
                                        <x-frontend.textarea name="support_instruction"
                                            :label="__('Support Instruction')"></x-frontend.textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Pricing') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <x-frontend.input-text name="price" label="{{ __('Regular Price') }}" required
                                            :value="$item->price" />
                                    </div>
                                    <div class="col-md-12">
                                        <x-frontend.input-text name="discount_price" label="{{ __('Discount Price') }}"
                                            :value="$item->discount_price" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1{{ __('Free Item') }} "></h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <x-frontend.input-select name="is_free" id="is_free"
                                            label="{{ __('Is Item Will Be Free?') }}">
                                            <option value="" disabled>{{ __('Select') }}</option>
                                            <option @selected($item->is_free == '0') value="0">{{ __('No') }}
                                            </option>
                                            <option @selected($item->is_free == '1') value="1">{{ __('Yes') }}
                                            </option>
                                        </x-frontend.input-select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Message To The Reviewer') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-12" id="message_reviewer">
                                        <x-frontend.textarea name="message_for_reviewer"
                                            :label="__('Message')"></x-frontend.textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4"
                            style="border-radius: 12px; position: sticky; top: 20px;">

                            <!-- Item Info  -->
                            @include('frontend.dashboard.layouts.partials.Item-Info')

                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end border-top pt-4 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold d-flex align-items-center gap-2"
                        style="background-color: #0061ff; border: none; border-radius: 8px;">
                        <i class="ti ti-device-floppy fs-5"></i>
                        {{ __('Update Item') }}
                    </button>
                </div>
            </form>

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

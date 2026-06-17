@extends('frontend.dashboard.layouts.master')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    <style>
        .dz-message {
            padding: 20px;
            border: 2px dashed #6c757d;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .dz-message:hover {
            background-color: #e9ecef;
        }

        .dz-message .bi-plus-circle {
            animation: bounce 2s infinite ease-in-out;
        }

        .dz-message .add-file-icon {
            font-size: 2rem;
            font-weight: bolder;
        }

        .dz-message .add-file-text {
            font-size: 1.5rem;
        }

        .file-text-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-list-item {
            background-color: #f8f9fa;
        }

        .dropzone {
            min-height: 150px;
            border: none;
            background: none;
            padding: 0;
        }

        .dropzone-custom-wrapper {
            cursor: pointer;
            padding: 30px 20px;
            border: 2px dashed #6c757d;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            position: relative;
            z-index: 999;
        }

        .dropzone-custom-wrapper:hover {
            background-color: #e9ecef;
            border-color: #0061ff;
        }

        .file-text-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-file-icon {
            font-size: 2rem;
            font-weight: bolder;
        }

        .add-file-text {
            font-size: 1.5rem;
        }

        .file-list-item {
            background-color: #f8f9fa;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper py-4">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">Add Item</h4>
                            <p class="text-muted mb-0">Fill in the details below to list your
                                digital asset.</p>
                        </div>
                        <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-2"
                            data-bs-toggle="modal" data-bs-target="#selectCategoryModal" style="border-radius: 8px;">
                            <i class="ti ti-plus"></i> Change Category
                        </button>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" id="mainItemForm">
                @csrf

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="fw-semibold text-dark mb-1">Name And Description</h5>
                            <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;"></div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <x-frontend.input-text name="name" label="{{ __('Name') }}" required />
                            </div>
                            <div class="col-md-12">
                                <x-frontend.textarea id="editor" name="description"
                                    label="{{ __('Description') }}"required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="fw-semibold text-dark mb-1">Category And Attributes</h5>
                            <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <input type="hidden" name="category" value="{{ request('category') }}">

                                <x-frontend.input-select name="category_display" label="{{ __('Category') }}"
                                    disabled="true">
                                    <option value="" disabled>Select</option>
                                    @foreach ($categories as $cat)
                                        <option @selected($cat->slug == request('category')) value="{{ $cat->slug }}">
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </x-frontend.input-select>
                            </div>

                            <div class="col-md-6">
                                <x-frontend.input-select name="sub_category" label="{{ __('Sub Category') }}" required>
                                    <option value="" selected disabled>Select
                                    </option>
                                    @foreach ($category->subCategories as $subcategory)
                                        <option value="{{ $subcategory->slug }}">
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </x-frontend.input-select>
                            </div>

                            <div class="col-md-6">
                                <x-frontend.input-text name="version" label="{{ __('Version') }}" required />
                            </div>

                            <div class="col-md-6">
                                <x-frontend.input-text name="demo_link" label="{{ __('Demo Link (Optional)') }}" />
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my_tags_input" class="form-label fw-semibold text-secondary mb-2">
                                        Search Tags <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="tags" id="my_tags_input" class="form-control" required
                                        placeholder="Type a tag and press Enter">
                                    <small class="text-muted d-block mt-1">Tags help
                                        customers find your items through
                                        search.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="fw-semibold text-dark mb-1">{{ __('Files') }}</h5>
                            <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="dropzone-custom-wrapper mt-4" id="fileUpload">
                                    <div class="text-center" style="pointer-events: none;">
                                        <div class="mb-2 file-text-wrapper">
                                            <i class="bi bi-plus add-file-icon"></i>
                                            <span class="add-file-text">File
                                                Upload</span>
                                        </div>
                                        <p class="text-muted mt-2">Drop files here
                                            or click to upload</p>
                                    </div>
                                </div>

                                <ul class="list-group mt-3" id="fileList">
                                    @foreach ($uploadFiles as $file)
                                        <li class="list-group-item file-list-item d-flex align-items-center justify-content-between "
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
                                                        role="progressbar" style="width: 100%;" id=""></div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
                                                onclick="removeFile('{{ $file->id }}')"><i class="bi bi-trash3"></i>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <x-frontend.input-select name="preview_type" label="{{ __('Preview Type') }}"
                                    id="preview_file_input" required>
                                </x-frontend.input-select>
                            </div>

                            <div class="col-md-6">
                                <x-frontend.input-select name="preview_file" label="{{ __('Preview File') }}" required>
                                    @foreach ($uploadFiles as $file)
                                        <option value="{{ $file->path }}">{{ $file->name }}</option>
                                    @endforeach
                                </x-frontend.input-select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label mb-2 font-18 font-heading fw-600">Main File<code>*</code></label>
                                <div class="input-group mb-3">
                                    <select class="form-select" id="main_resource_select">
                                        <option value="" selected disabled>
                                            {{ __('Select') }}</option>
                                        <option value="upload">{{ __('Upload') }}
                                        </option>
                                        <option value="link">{{ __('Link') }}
                                        </option>
                                    </select>
                                    <select class="form-select d-none" id="upload_source">
                                        @foreach ($uploadFiles as $file)
                                            <option value="{{ $file->path }}">{{ $file->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" id="link_source"
                                        aria-label="Text input with dropdown button">
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

                <div class="d-flex justify-content-end border-top pt-4 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold d-flex align-items-center gap-2"
                        style="background-color: #0061ff; border: none; border-radius: 8px;">
                        <i class="ti ti-device-floppy fs-5"></i>
                        {{ __('Save Item') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        var notyf = new Notyf({
            duration: 5000,
        });
        const csrfToken = "{{ csrf_token() }}";

        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("#fileUpload", {
            url: "{{ route('user.items.uploads') }}",
            method: 'post',
            maxFilesize: 100,
            parallelUploads: 5,
            uploadMultiple: true,
            addRemoveLinks: false,
            previewsContainer: false,
            clickable: "#fileUpload",
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            init: function() {
                this.on("addedfile", function(file) {
                    createListItem(file);
                });
                this.on("uploadprogress", function(file, progress) {
                    const progressBar = document.getElementById(`progress-${file.upload.uuid}`);
                    if (progressBar) {
                        progressBar.style.width = `${progress}%`;
                    }
                });
                this.on("success", function(file, response) {
                    const uploadedFileFromServer = response.files[response.files.length - 1];

                    const listItem = document.getElementById(`file-${file.upload.uuid}`);
                    if (listItem) {
                        const progressBar = listItem.querySelector(".progress-bar");
                        progressBar.classList.remove("progress-bar-animated");
                        progressBar.classList.add("bg-success");
                        progressBar.style.width = "100%";

                        listItem.id = `file-${uploadedFileFromServer.id}`;
                        const deleteBtn = listItem.querySelector("button");
                        deleteBtn.setAttribute("onclick", `removeFile('${uploadedFileFromServer.id}')`);
                    }

                    var previewFileInput = document.getElementById('preview_file_input');
                    var ScreenshotsInput = document.getElementById('screenshot_input');
                    var UploadSource = document.getElementById('upload_source');

                    for (let i = 0; i < response.files.length; i++) {
                        var previewOption = document.createElement('option');
                        previewOption.value = response.files[i].path;
                        previewOption.text = response.files[i].name;
                        previewFileInput.add(previewOption);

                        var screenOption = document.createElement('option');
                        screenOption.value = response.files[i].path;
                        screenOption.text = response.files[i].name;
                        ScreensInput.add(screenOption);

                        var uploadOPtion = document.createElement('option');
                        uploadOPtion.value = response.files[i].path;
                        uploadOPtion.text = response.files[i].name;
                        UploadSource.add(uploadOPtion);
                    }
                });
                this.on("error", function(file, errorMessage) {
                    let message = "Upload failed";
                    if (typeof errorMessage === 'string') {
                        message = errorMessage;
                    } else if (errorMessage && errorMessage.errors) {
                        message = Object.values(errorMessage.errors).flat().join(', ');
                    } else if (errorMessage && errorMessage.message) {
                        message = errorMessage.message;
                    }

                    notyf.error(message);

                    const listItem = document.getElementById(`file-${file.upload.uuid}`);
                    if (listItem) {
                        const progressBar = listItem.querySelector(".progress-bar");
                        if (progressBar) {
                            progressBar.classList.remove("progress-bar-striped",
                                "progress-bar-animated");
                            progressBar.classList.add("bg-danger");
                            progressBar.style.width = "100%";
                        }
                    }
                });
            },
        });

        function getIcon(fileType) {
            let fileIcon = "bi-file-earmark";
            if (fileType.startsWith("image/")) fileIcon = "bi-file-earmark-image";
            else if (fileType.startsWith("video/")) fileIcon = "bi-file-earmark-play";
            else if (fileType.startsWith("audio/")) fileIcon = "bi-file-earmark-music";
            else if (fileType.endsWith("pdf")) fileIcon = "bi-file-earmark-pdf";
            else if (fileType.startsWith("text/")) fileIcon = "bi-file-earmark-text";
            else if (fileType.startsWith("application/")) fileIcon = "bi-file-earmark-zip";
            return fileIcon;
        }

        function createListItem(file) {
            const fileIcon = getIcon(file.type);
            const listItem = document.createElement("li");
            listItem.className = "list-group-item file-list-item d-flex align-items-center justify-content-between";
            listItem.id = `file-${file.upload.uuid}`;
            listItem.innerHTML = `
    <div class="w-100">
        <div class="d-flex align-items-center mb-2">
            <i class="bi ${fileIcon} fs-3 me-3 text-primary"></i>
            <span>${file.name} <span class="file-size text-muted">(${getFileSize(file)})</span></span>
        </div>
        <div class="progress me-3" style="width:100%; height: 5px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 role="progressbar"
                 style="width: 0%;"
                 id="progress-${file.upload.uuid}"></div>
        </div>
    </div>
    <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
            onclick="cancelOrRemoveTmpFile('${file.upload.uuid}', this)">
        <i class="bi bi-trash3"></i>
    </button>
`;
            document.getElementById("fileList").appendChild(listItem);
        }

        function getFileSize(file) {
            const size = file.size;
            const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
            return `(${(size / Math.pow(1024, i)).toFixed(2) * 1} ${["B", "KB", "MB", "GB", "TB"][i]})`;
        }

        function removeFile(id) {
            const listItem = document.getElementById(`file-${id}`);
            const deleteUrl = "{{ route('user.item.destroy', ':id') }}".replace(':id', id);

            fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (listItem) {
                        listItem.remove();
                    }
                    if (typeof notyf !== 'undefined') {
                        notyf.success('File removed successfully');
                    }
                })
                .catch(error => {
                    if (typeof notyf !== 'undefined') {
                        notyf.error('Failed to delete file');
                    }
                });
        }

        document.getElementById('main_resource_select').addEventListener('change', function() {
            const value = this.value;
            const UploadSource = document.getElementById('upload_source');
            const LinkSource = document.getElementById('link_source');

            if (value === 'upload') {
                UploadSource.classList.remove('d-none');
                LinkSource.classList.add('d-none');
            } else if (value === 'link') {
                UploadSource.classList.add('d-none');
                LinkSource.classList.remove('d-none');
            }
        });
    </script>
@endpush

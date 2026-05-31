@extends('admin.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/easy-icon-picker.css') }}">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-body py-4">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        <div class="card-header bg-white border-0 py-4 px-4 border-bottom bg-light-subtle">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div>
                                    <h3 class="card-title fw-bold mb-1 text-dark">
                                        {{ __('All Categories') }}
                                    </h3>
                                    <p class="text-muted small mb-0">
                                        {{ __('Manage your marketplace categories and their supported digital file extensions.') }}
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="btn btn-primary btn-m
                                        d rounded-3 px-4 fw-semibold shadow-sm">
                                        <i class="bi bi-plus-circle-fill me-2"></i>{{ __('Add New Category') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 border-bottom">
                            <form action="#" method="POST">
                                <div class="row g-3">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold text-dark">{{ __('Category Icon') }}</label>
                                        <div class="easy-icon-picker" data-picker="category-icon"></div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold text-dark">{{ __('Supported File Types') }}</label>
                                        <input type="text" class="form-control" name="file_type"
                                            placeholder="e.g. zip, jpg, mp4">
                                        <span class="text-muted d-block mt-1" style="font-size: 12px;">
                                            {{ __('The allowed files to be uploaded as main file. e.g. ZIP, JPG, MP4, MP3, PNG, etc.') }}
                                        </span>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <th class="ps-4 py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Category info') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Slug') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Supported Files') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Created At') }}</th>
                                        <th class="text-end pe-4 py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom-0">
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary-soft text-primary rounded-3 d-flex align-items-center justify-content-center border"
                                                    style="width:48px; height:48px; background-color: rgba(13, 110, 253, 0.08);">
                                                    <i class="bi bi-image fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        Graphics Design
                                                    </h6>
                                                    <small class="text-muted fw-mono fs-7">
                                                        ID: #1
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="py-3">
                                            <span
                                                class="font-monospace text-secondary bg-light px-2.5 py-1 rounded border small">
                                                graphics-design
                                            </span>
                                        </td>

                                        <td class="py-3">
                                            <div class="d-flex flex-wrap gap-1.5" style="max-width: 300px;">
                                                <span
                                                    class="badge bg-dark-subtle text-dark border rounded-pill px-2.5 py-1.5 fw-semibold text-uppercase fs-7">
                                                    <i class="bi bi-file-earmark-code me-1 text-secondary"></i>PNG
                                                </span>
                                                <span
                                                    class="badge bg-dark-subtle text-dark border rounded-pill px-2.5 py-1.5 fw-semibold text-uppercase fs-7">
                                                    <i class="bi bi-file-earmark-code me-1 text-secondary"></i>JPG
                                                </span>
                                                <span
                                                    class="badge bg-dark-subtle text-dark border rounded-pill px-2.5 py-1.5 fw-semibold text-uppercase fs-7">
                                                    <i class="bi bi-file-earmark-code me-1 text-secondary"></i>PSD
                                                </span>
                                            </div>
                                        </td>

                                        <td class="py-3 text-muted small">
                                            <div class="d-flex align-items-center gap-1">
                                                <i class="bi bi-calendar3 opacity-75"></i>
                                                <span>2 hours ago</span>
                                            </div>
                                        </td>

                                        <td class="py-3 pe-4 text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="#"
                                                    class="btn btn-light btn-sm border rounded-2 p-2 shadow-sm"
                                                    title="{{ __('Edit') }}">
                                                    <i class="bi bi-pencil-square text-primary fs-6"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-light btn-sm border rounded-2 p-2 shadow-sm"
                                                    title="{{ __('Delete') }}">
                                                    <i class="bi bi-trash3-fill text-danger fs-6"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-white border-0 py-3.5 px-4 border-top">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <small class="text-muted fw-medium">
                                    Showing 1 to 1 of 1 entries
                                </small>
                                <nav>
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link rounded-start-3" href="#">Prev</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link rounded-end-3" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/js/easy-icon-picker.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.easy-icon-picker').easyIconPicker({});
        });
    </script>
@endpush

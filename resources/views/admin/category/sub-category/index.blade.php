@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body py-4">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        <!-- Header Section -->
                        <div class="card-header bg-white border-0 py-4 px-4 border-bottom bg-light-subtle">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 w-100">
                                <div>
                                    <h3 class="card-title fw-bold mb-1 text-dark">
                                        {{ __('All Categories') }}
                                    </h3>
                                    <p class="text-muted small mb-0">
                                        {{ __('Manage your marketplace categories and their supported digital file extensions.') }}
                                    </p>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('admin.sub-categories.create') }}"
                                        class="btn btn-primary btn-md rounded-3 px-4 fw-semibold shadow-sm">
                                        <i class="bi bi-plus-circle-fill me-2"></i>{{ __('Add New  Sub Category') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <th class="ps-4 py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Sub Category Name') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Slug') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Parent Category') }}</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Created At') }}</th>
                                        <th class="text-end pe-4 py-3 fw-bold text-secondary text-uppercase fs-7"
                                            style="letter-spacing: 0.5px;">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($subcategory as $category)
                                        <tr>

                                            {{-- Category --}}
                                            <td class="ps-4 py-3">

                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $category->name }}
                                                </div>
                                            </td>

                                            <td class="ps-4 py-3">

                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $category->slug }}
                                                </div>
                                            </td>
                                            <td class="ps-4 py-3">

                                                <div class="d-flex align-items-center gap-3">
                                                    {{ $category->category?->name }}
                                                </div>
                                            </td>


                                            {{-- Created Date --}}
                                            <td class="py-3">

                                                <div class="d-flex align-items-center gap-2 text-muted">

                                                    <i class="bi bi-calendar3"></i>

                                                    <span>
                                                        {{ $category->created_at->diffForHumans() }}
                                                    </span>

                                                </div>

                                            </td>

                                            {{-- Actions --}}
                                            <td class="py-3 pe-4 text-end">

                                                <div class="btn-list justify-content-end">

                                                    <a href="{{ route('admin.sub-categories.edit', $category->id) }}"
                                                        class="btn btn-outline-primary btn-icon btn-sm"
                                                        title="{{ __('Edit') }}">

                                                        <i class="bi bi-pencil-square"></i>

                                                    </a>

                                                    <form
                                                        action="{{ route('admin.sub-categories.destroy', $category->id) }}"
                                                        method="POST" class="d-inline delete-form">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-icon btn-sm"
                                                            title="{{ __('Delete') }}">

                                                            <i class="bi bi-trash3"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="4" class="text-center py-5">

                                                <div class="empty">

                                                    <div class="empty-img mb-3">

                                                        <i class="bi bi-folder2-open fs-1 text-muted"></i>

                                                    </div>

                                                    <p class="empty-title fw-semibold">
                                                        {{ __('No Sub Categories Found') }}
                                                    </p>

                                                    <p class="empty-subtitle text-muted">
                                                        {{ __('Create your first Sub category to get started.') }}
                                                    </p>

                                                </div>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Footer -->
                        <div class="card-footer bg-white border-0 py-3.5 px-4 border-top">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <small class="text-muted fw-medium">
                                    Showing {{ $subcategory->firstItem() }} to {{ $subcategory->lastItem() }} of
                                    {{ $subcategory->total() }} entries
                                </small>
                                <nav>
                                    {{ $subcategory->links() }}
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

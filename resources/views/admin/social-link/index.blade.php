@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card shadow-sm border-0">
                    <div
                        class="card-header bg-transparent border-0 px-4 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <h3 class="card-title fw-bold">{{ __('Social Links') }}</h3>
                        <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> {{ __('Add New') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Icon') }}</th>
                                        <th>{{ __('URL') }}</th>
                                        <th class="w-8">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($socialLinks as $link)
                                        <tr>
                                            <td>
                                                <i class="{{ $link->icon }}" style="font-size: 40px;"></i>
                                            </td>
                                            <td>{{ $link->url }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.social-links.edit', $link->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="ti ti-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.social-links.destroy', $link->id) }}"
                                                        class="btn btn-sm btn-danger delete-item">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <div class="alert alert-warning mb-0">
                                                    {{ __('No data found!') }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

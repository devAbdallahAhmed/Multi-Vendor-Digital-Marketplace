@extends('admin.layouts.master', ['counts' => $counts])

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Approved Items') }}</h3>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Details') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Updated At') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $item)
                                            <tr>
                                                <td><span class="text-muted">#{{ $item->id }}</span></td>

                                                <td>
                                                    <div class="d-flex py-1 align-items-center">
                                                        @if ($item->preview_type === 'image' && $item->preview_image)
                                                            <img src="{{ asset($item->preview_image) }}" class="avatar me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        @elseif($item->preview_type === 'video')
                                                            <img src="{{ asset('defaults/video.webp') }}" class="avatar me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('defaults/audio.webp') }}" class="avatar me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        @endif

                                                        <div class="flex-fill">
                                                            <div class="font-weight-medium">
                                                                <strong>{{ $item->title }}</strong>
                                                            </div>
                                                            <div class="text-muted mt-1">
                                                                {{ __('Author:') }} <span class="text-primary font-weight-bold">{{ $item->author->name ?? 'Unknown' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="font-weight-medium">{{ $item->category->name ?? '' }}</div>
                                                    <div class="text-muted mt-1">{{ $item->sub_category->name ?? '' }}</div>
                                                </td>

                                                <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>

                                                <td>
                                                    <span class="badge bg-success-lt">{{ __('Approved') }}</span>
                                                </td>

                                                <td class="text-end">
                                                    <a href="{{ route('admin.items-review.show', $item->id) }}" class="btn btn-sm btn-icon btn-primary" title="{{ __('Review Item') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    {{ __('No approved items found.') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-end">
                            @if ($items->hasPages())
                                <div class="m-0 ms-auto">
                                    {{ $items->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
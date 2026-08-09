@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header border-0 bg-white p-4">
                <h5 class="fw-bold mb-1">{{ __('My Reviews') }}</h5>
                <p class="text-muted mb-0">{{ __('Manage and view all the reviews you have written.') }}</p>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4 fw-semibold border-bottom">{{ __('Product Details') }}</th>
                                <th class="py-3 fw-semibold border-bottom">{{ __('Rating') }}</th>
                                <th class="py-3 fw-semibold border-bottom" style="min-width: 300px;">{{ __('Review') }}
                                </th>
                                <th class="py-3 fw-semibold border-bottom">{{ __('Date') }}</th>
                                <th class="py-3 fw-semibold text-center border-bottom">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0" style="width:65px;height:65px;">
                                                @if ($review->item->preview_type === 'image' && $review->item->main_file)
                                                    <img src="{{ asset($review->item->preview_image ?? $review->item->main_file) }}"
                                                        alt="{{ $review->item->name }}" class="rounded-3 border w-100 h-100"
                                                        style="object-fit:cover;">
                                                @elseif ($review->item->preview_type === 'video' && $review->item->main_file)
                                                    <img src="{{ asset('defaults/video.webp') }}"
                                                        alt="{{ $review->item->name }}"
                                                        class="rounded-3 border w-100 h-100" style="object-fit:cover;">
                                                @elseif ($review->item->preview_type === 'audio' && $review->item->main_file)
                                                    <img src="{{ asset('defaults/audio.webp') }}"
                                                        alt="{{ $review->item->name }}"
                                                        class="rounded-3 border w-100 h-100" style="object-fit: cover;">
                                                @endif
                                            </div>

                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-dark">
                                                    {{ Str::limit($review->item->name, 30) }}
                                                </h6>
                                                <div class="small text-muted mb-1 text-nowrap">
                                                    <span class="text-primary fw-semibold">
                                                        {{ $review->item->category->name ?? 'Uncategorized' }}
                                                    </span>
                                                    <span class="mx-1">/</span>
                                                    <span>
                                                        {{ $review->item->sub_category->name ?? 'None' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3">
                                        <div class="text-warning small d-flex align-items-center gap-1">
                                            <span class="text-warning ms-2">
                                                @for ($i = 1; $i <= $review->stars; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                                @for ($i = $review->stars + 1; $i <= 5; $i++)
                                                    <i class="far fa-star"></i>
                                                @endfor
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-3">
                                        <p class="mb-0 text-dark small" style="white-space: pre-wrap;">
                                            {{ Str::limit($review->body, 80) }}</p>
                                    </td>

                                    <td class="py-3 text-muted small">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ $review->created_at->format('M d, Y') }}
                                    </td>

                                    <td class="text-center py-3">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#" class="btn btn-primary btn-sm px-2 py-1" target="_blank"
                                                title="View Item">
                                                <i class="ti ti-external-link"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                style="width:80px;height:80px;">
                                                <i class="ti ti-message-star fs-1 text-secondary"></i>
                                            </div>
                                            <h5 class="fw-semibold mb-1">
                                                {{ __('No reviews written yet') }}
                                            </h5>
                                            <p class="text-muted small">
                                                {{ __('When you review a product, it will appear here.') }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($reviews->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

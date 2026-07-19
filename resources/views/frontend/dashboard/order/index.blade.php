@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header border-0 bg-white p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">My Orders</h5>
                    <p class="text-muted mb-0">Manage your Orders.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectCategoryModal">
                    <i class="ti ti-plus"></i> Add Item
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4 fw-semibold border-bottom">Purchase ID</th>
                                <th class="py-3 fw-semibold border-bottom" style="min-width: 300px;">Product Details</th>
                                <th class="py-3 fw-semibold border-bottom">Purchase Date</th>
                                <th class="py-3 fw-semibold text-center border-bottom">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-4 fw-medium text-dark">
                                        #{{ $order->id }}
                                    </td>

                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0" style="width:65px;height:65px;">
                                                @if ($order->item->preview_type === 'image' && $order->item->preview_image)
                                                    <img src="{{ asset($order->item->preview_image) }}"
                                                        alt="{{ $order->item->name }}" class="rounded-3 border w-100 h-100"
                                                        style="object-fit:cover;">
                                                @elseif ($order->item->preview_type === 'video' && $order->item->preview_video)
                                                    <img src="{{ asset('defaults/video.webp') }}"
                                                        alt="{{ $order->item->name }}" class="rounded-3 border w-100 h-100"
                                                        style="object-fit:cover;">
                                                @elseif ($order->item->preview_type === 'audio' && $order->item->preview_audio)
                                                    <img src="{{ asset('defaults/audio.webp') }}"
                                                        alt="{{ $order->item->name }}" class="rounded-3 border w-100 h-100"
                                                        style="object-fit: cover;">
                                                @endif
                                            </div>

                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-dark">
                                                    {{ $order->item->name }}
                                                </h6>

                                                <div class="small text-muted mb-1 text-nowrap">
                                                    <span class="text-primary fw-semibold">
                                                        {{ $order->item->category->name ?? 'Uncategorized' }}
                                                    </span>
                                                    <span class="mx-1">/</span>
                                                    <span>
                                                        {{ $order->item->sub_category->name ?? 'None' }}
                                                    </span>
                                                </div>

                                                <div class="text-warning small mb-1 d-flex align-items-center gap-1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="ti ti-star-filled"></i>
                                                    @endfor
                                                </div>
                                                <a href="#" class="text-decoration-none small fw-medium">Write a
                                                    review</a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3 text-muted">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>

                                    <td class="text-center py-3">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-primary btn-sm px-2 py-1">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-success btn-sm px-2 py-1">
                                                <i class="ti ti-download"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                style="width:80px;height:80px;">
                                                <i class="ti ti-folder-off fs-1 text-secondary"></i>
                                            </div>
                                            <h5 class="fw-semibold mb-1">
                                                No data found
                                            </h5>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="selectCategoryModal" tabindex="-1" aria-labelledby="selectCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 12px;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="selectCategoryModalLabel" style="font-size: 1.25rem;">Select
                            Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('user.items.create') }}" method="Get">
                        @csrf
                        <div class="modal-body py-3">
                            <div class="mb-3">
                                <x-admin.input-select name="category" id="category_select" :label="__('Category')" required>
                                    <option value="" selected disabled>Select</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-admin.input-select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                                style="border-radius: 8px;">Close</button>
                            <button type="submit" class="btn btn-primary px-4"
                                style="background-color: #0061ff; border: none; border-radius: 8px;">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="wsus__dash_order_table">

        {{-- Header Section with Search --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h5>My Items</h5>
                <p class="mb-0 text-muted">Manage your Items.</p>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                {{-- Search Form --}}
                <form action="{{ route('user.items.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group shadow-sm" style="min-width: 250px;">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control border-end-0" placeholder="Search items..." style="border-radius: 8px 0 0 8px;">
                        <button class="btn btn-outline-secondary border-start-0 bg-white" type="submit" style="border-radius: 0 8px 8px 0;">
                            <i class="ti ti-search text-primary"></i>
                        </button>
                    </div>
                </form>

                {{-- Add Item Button --}}
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#selectCategoryModal" style="border-radius: 8px;">
                    <i class="ti ti-plus"></i> Add Item
                </button>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm rounded border">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-4 border-0">Details</th>
                        <th class="py-3 border-0">Price</th>
                        <th class="py-3 border-0">Publish Date</th>
                        <th class="py-3 border-0">Status</th>
                        <th class="d-flex py-3 text-center align-center mr-auto border-0">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($items as $item)
                        <tr>
                            {{-- Details --}}
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0" style="width:60px;height:60px;">
                                        @if ($item->preview_type === 'image' && $item->preview_image)
                                            <img src="{{ asset($item->main_file)?? $item->preview_image  }}" alt="{{ $item->name }}"
                                                class="rounded-3 border w-100 h-100" style="object-fit:cover;">
                                        @elseif ($item->preview_type === 'video' && $item->preview_video)
                                            <img src="{{ asset('defaults/video.webp') }}" alt="{{ $item->name }}"
                                                class="rounded-3 border w-100 h-100" style="object-fit:cover;">
                                        @elseif ($item->preview_type === 'audio' && $item->preview_audio)
                                            <img src="{{ asset('defaults/audio.webp') }}" alt="{{ $item->name }}"
                                                class="rounded-3 border w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <div class="rounded-3 border w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                <i class="ti ti-photo text-muted fs-4"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-1 fw-bold text-dark">
                                            {{ $item->name }}
                                        </h6>
                                        <div class="small text-muted d-flex align-items-center gap-1">
                                            <span class="text-primary fw-semibold">
                                                {{ $item->category?->name ?? 'Uncategorized' }}
                                            </span>
                                            <span>•</span>
                                            <span>
                                                {{ $item->sub_category?->name ?? 'None' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Price --}}
                            <td class="py-3">
                                @if ($item->is_free)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold border border-success-subtle">
                                        Free
                                    </span>
                                @else
                                    @if ($item->discount_price > 0)
                                        <div class="fw-bold text-success" style="font-size: 1.1rem;">
                                            ${{ number_format($item->discount_price, 2) }}
                                        </div>
                                        <small class="text-muted text-decoration-line-through">
                                            ${{ number_format($item->price, 2) }}
                                        </small>
                                    @else
                                        <span class="fw-bold text-dark" style="font-size: 1.1rem;">
                                            ${{ number_format($item->price, 2) }}
                                        </span>
                                    @endif
                                @endif
                            </td>

                            {{-- Date --}}
                            <td class="py-3">
                                <div class="text-muted small fw-medium">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $item->created_at->format('M d, Y') }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="py-3">
                                @if ($item->status === 'active')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold border border-success-subtle">
                                        Active
                                    </span>
                                @elseif ($item->status === 'pending')
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 fw-semibold border border-warning-subtle">
                                        Pending
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fw-semibold border border-secondary-subtle">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('user.items.edit', $item->id) }}"
                                        class="btn btn-light border shadow-sm rounded-3 btn-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit">
                                        <i class="ti ti-pencil text-primary"></i>
                                    </a>
                                    <form action="{{ route('user.items.destroy', $item->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border shadow-sm rounded-3 btn-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            title="Delete">
                                            <i class="ti ti-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 border-0">
                                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                        style="width:70px;height:70px;">
                                        <i class="ti ti-folder-off fs-2 text-secondary"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1 text-dark">
                                        No Items Found
                                    </h5>
                                    @if(request('search'))
                                        <p class="text-muted mb-0">
                                            We couldn't find any items matching "{{ request('search') }}".
                                        </p>
                                        <a href="{{ route('user.items.index') }}" class="btn btn-link text-primary mt-2 text-decoration-none">Clear Search</a>
                                    @else
                                        <p class="text-muted mb-0">
                                            You haven't uploaded any products yet.
                                        </p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination (If needed) --}}
        @if($items->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>

    {{-- Modal Category Select --}}
    <div class="modal fade" id="selectCategoryModal" tabindex="-1" aria-labelledby="selectCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="selectCategoryModalLabel" style="font-size: 1.25rem;">Select Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('user.items.create') }}" method="Get">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <x-admin.input-select name="category" id="category_select" :label="__('Category')" required>
                                <option value="" selected disabled>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </x-admin.input-select>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-light fw-medium px-4 border" data-bs-dismiss="modal"
                            style="border-radius: 8px;">Cancel</button>
                        <button type="submit" class="btn btn-primary fw-medium px-4 shadow-sm"
                            style="border-radius: 8px;">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

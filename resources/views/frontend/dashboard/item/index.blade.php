@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="wsus__dash_order_table">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5>My Items</h5>
                <p>Manage your Items.</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectCategoryModal">
                <i class="ti ti-plus"></i> Add Item
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm rounded border">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-4">Details</th>
                        <th class="py-3">Price</th>
                        <th class="py-3">Publish Date</th>
                        <th class="py-3">Status</th>
                        <th class="d-flex py-3 text-center align-center mr-auto">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>

                            {{-- Details --}}
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0" style="width:70px;height:70px;">

                                        @if ($item->preview_type === 'image' && $item->preview_image)
                                            <img src="{{ asset($item->preview_image) }}" alt="{{ $item->name }}"
                                                class="rounded-3 border w-100 h-100" style="object-fit:cover;">
                                        @else
                                            <div
                                                class="bg-light border rounded-3 d-flex align-items-center justify-content-center w-100 h-100">
                                                <i class="ti ti-photo text-muted fs-2"></i>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="ms-3 flex-grow-1">

                                        <h6 class="mb-1 fw-bold">
                                            {{ $item->name }}
                                        </h6>

                                        <div class="small text-muted">

                                            <span class="text-primary fw-semibold">
                                                {{ $item->category->name ?? 'Uncategorized' }}
                                            </span>


                                            <span>
                                                {{ $item->sub_category->name ?? 'None' }}
                                            </span>

                                        </div>

                                    </div>

                                </div>
                            </td>

                            {{-- Price --}}
                            <td class="py-3">

                                @if ($item->is_free)
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        Free
                                    </span>
                                @else
                                    @if ($item->discount_price > 0)
                                        <div class="fw-bold text-success fs-5">
                                            ${{ $item->discount_price }}
                                        </div>

                                        <small class="text-muted text-decoration-line-through">
                                            ${{ $item->price }}
                                        </small>
                                    @else
                                        <span class="fw-bold fs-5 text-dark">
                                            ${{ $item->price }}
                                        </span>
                                    @endif
                                @endif

                            </td>

                            {{-- Date --}}
                            <td class="py-3">
                                <div class="text-muted">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $item->created_at->format('M d, Y') }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="py-3">

                                @if ($item->status === 'active')
                                    <span class="badge bg-success rounded-pill px-1 py-2">
                                        Active
                                    </span>
                                @elseif ($item->status === 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-1 py-2">
                                        Pending
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-1 py-2">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif

                            </td>

                            {{-- Actions --}}
                            <td class="text-center py-3">

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('user.items.edit', $item->id) }}"
                                        class="btn btn-light border rounded-3 btn-sm" title="Edit">

                                        <i class="ti ti-pencil text-primary"></i>

                                    </a>

                                    <form action="{{ route('user.items.destroy', $item->id) }}" method="POST"
                                        class="m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-light border rounded-3 btn-sm"
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
                            <td colspan="5" class="text-center py-5">

                                <div class="d-flex flex-column align-items-center">

                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                        style="width:80px;height:80px;">

                                        <i class="ti ti-folder-off fs-1 text-secondary"></i>

                                    </div>

                                    <h5 class="fw-semibold mb-1">
                                        No Items Found
                                    </h5>

                                    <p class="text-muted mb-0">
                                        You haven't uploaded any products yet.
                                    </p>

                                </div>

                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
@endsection

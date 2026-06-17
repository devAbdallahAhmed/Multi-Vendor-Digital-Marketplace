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
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">serial</th>
                        <th class="details">details</th>
                        <th class="p_date">Purchase Date</th>
                        <th class="e_date">Expired Date</th>
                        <th class="price">Price</th>
                        <th class="action">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="sn">
                            <p>1</p>
                        </td>
                        <td class="details">
                            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                        </td>
                        <td class="p_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="e_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="price">
                            <p>$300</p>
                        </td>
                        <td class="action">
                            <a class="view" href="#"><i class="ti ti-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="sn">
                            <p>2</p>
                        </td>
                        <td class="details">
                            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                        </td>
                        <td class="p_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="e_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="price">
                            <p>$300</p>
                        </td>
                        <td class="action">
                            <a class="view" href="#"><i class="ti ti-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="sn">
                            <p>3</p>
                        </td>
                        <td class="details">
                            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                        </td>
                        <td class="p_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="e_date">
                            <p>2021-12-28</p>
                        </td>
                        <td class="price">
                            <p>$300</p>
                        </td>
                        <td class="action">
                            <a class="view" href="#"><i class="ti ti-eye"></i></a>
                        </td>
                    </tr>
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

@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background-image: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><span><i class="fas fa-chevron-right font-10"></i></span></li>
                        <li>
                            <span>
                                @if (request()->has('category'))
                                    {{ ucfirst(request()->category) }}
                                @else
                                    {{ __('Products') }}
                                @endif
                            </span>
                        </li>
                    </ul>
                    <h3 class="prem-breadcrumb-title">
                        @if (request()->has('category'))
                            {{ __('Explore') }} {{ ucfirst(request()->category) }}
                        @else
                            {{ __('Our Digital Products') }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="prem-shop-section">
        <div class="container container-two">
            <div class="row">

                <div class="col-lg-12">
                    <div class="prem-filter-top">
                        <button type="button" class="prem-btn-filter">
                            <i class="ti ti-filter"></i> Filters
                        </button>
                        <ul class="prem-nav-pills nav" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-product-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-product" type="button" role="tab">All Item</button>
                            </li>
                        </ul>
                    </div>

                    <form action="{{ route('products') }}" method="GET" class="prem-filter-form">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('rating'))
                            <input type="hidden" name="rating" value="{{ request('rating') }}">
                        @endif

                        <div class="row gy-3">
                            <div class="col-sm-5">
                                <div class="prem-input-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="name">{{ __('Name') }}</label>
                                        <button type="reset" class="clear-btn">{{ __('Clear') }}</button>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="prem-form-control" id="name"
                                        placeholder="Search By Name Or Description...">
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="prem-input-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="Price">{{ __('Price') }}</label>
                                        <button type="reset" class="clear-btn">{{ __('Clear') }}</button>
                                    </div>
                                    <input type="text" name="price" value="{{ request('price') }}"
                                        class="prem-form-control" id="Price" placeholder="$7 - $29">
                                </div>
                            </div>

                            <div class="col-sm-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="prem-sidebar-widget">
                        <h4 class="prem-widget-title">Category</h4>
                        <ul class="prem-category-list">
                            <li><a href="{{ route('products') }}">All Categories <span
                                        class="qty">{{ $totalProductsCount }}</span></a></li>
                            @foreach ($categories as $category)
                                <li>
                                    <a
                                        href="{{ route('products', ['category' => $category->slug, 'search' => request('search'), 'rating' => request('rating')]) }}">
                                        {{ $category->name }}
                                        <span class="qty">{{ $category->items_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <form action="{{ route('products') }}" method="GET">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="prem-sidebar-widget">
                            <h4 class="prem-widget-title">{{ __('Rating') }}</h4>

                            <div class="prem-radio-group">
                                <label for="fiveStar">
                                    <input type="radio" name="rating" id="fiveStar" value="5"
                                        {{ request('rating') == '5' ? 'checked' : '' }}>
                                    <span>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                </label>
                                <span class="qty">({{ $productCountByRating[5] ?? 0 }})</span>
                            </div>

                            <div class="prem-radio-group">
                                <label for="fourStar">
                                    <input type="radio" name="rating" id="fourStar" value="4"
                                        {{ request('rating') == '4' ? 'checked' : '' }}>
                                    <span>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </span>
                                </label>
                                <span class="qty">({{ $productCountByRating[4] ?? 0 }})</span>
                            </div>

                            <div class="prem-radio-group">
                                <label for="threeStar">
                                    <input type="radio" name="rating" id="threeStar" value="3"
                                        {{ request('rating') == '3' ? 'checked' : '' }}>
                                    <span>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </span>
                                </label>
                                <span class="qty">({{ $productCountByRating[3] ?? 0 }})</span>
                            </div>

                            <div class="prem-radio-group">
                                <label for="twoStar">
                                    <input type="radio" name="rating" id="twoStar" value="2"
                                        {{ request('rating') == '2' ? 'checked' : '' }}>
                                    <span>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </span>
                                </label>
                                <span class="qty">({{ $productCountByRating[2] ?? 0 }})</span>
                            </div>

                            <div class="prem-radio-group">
                                <label for="oneStar">
                                    <input type="radio" name="rating" id="oneStar" value="1"
                                        {{ request('rating') == '1' ? 'checked' : '' }}>
                                    <span>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </span>
                                </label>
                                <span class="qty">({{ $productCountByRating[1] ?? 0 }})</span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('Filter') }}</button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-product" role="tabpanel">
                            <div class="row gy-4">
                                @forelse ($items as $item)
                                    <x-frontend.product-card :item="$item" />
                                @empty
                                    <div class="col-12 text-center mt-5">
                                        <h5 class="text-muted">{{ __('No products found.') }}</h5>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-5 d-flex justify-content-center">
                                <x-frontend.pagination :paginator="$items" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

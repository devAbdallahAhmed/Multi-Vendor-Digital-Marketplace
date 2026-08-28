@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb Section -->
    <section class="prem-breadcrumb" style="background-image: url('{{ asset(config('settings.breadcrumb')) }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><span><i class="fas fa-chevron-right font-10"></i></span></li>
                        <li>
                            <span>
                                {{ request()->has('category') ? ucfirst(request()->category) : __('Products') }}
                            </span>
                        </li>
                    </ul>
                    <h3 class="prem-breadcrumb-title">
                        {{ request()->has('category') ? __('Explore') . ' ' . ucfirst(request()->category) : __('Our Digital Products') }}
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Section -->
    <section class="prem-shop-section">
        <div class="container container-two">
            <div class="row">

                <!-- Search & Filters Top -->
                <div class="col-lg-12">
                    <div class="prem-filter-top">
                        <button type="button" class="prem-btn-filter">
                            <i class="ti ti-filter"></i> {{ __('Filters') }}
                        </button>
                        <ul class="prem-nav-pills nav" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-product-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-product" type="button" role="tab">{{ __('All Item') }}</button>
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

                <!-- Sidebar Category & Ratings -->
                <div class="col-xl-3 col-lg-4">
                    <div class="prem-sidebar-widget">
                        <h4 class="prem-widget-title">{{ __('Category') }}</h4>
                        <ul class="prem-category-list">
                            <li>
                                <a href="{{ route('products') }}">{{ __('All Categories') }}
                                    <span class="qty">{{ $totalProductsCount ?? 0 }}</span>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('products', ['category' => $category->slug, 'search' => request('search'), 'rating' => request('rating')]) }}">
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

                            @for ($rating = 5; $rating >= 1; $rating--)
                                <div class="prem-radio-group">
                                    <label for="{{ $rating }}Star">
                                        <input type="radio" name="rating" id="{{ $rating }}Star" value="{{ $rating }}"
                                            {{ request('rating') == $rating ? 'checked' : '' }}>
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </span>
                                    </label>
                                    <span class="qty">({{ $productCountByRating[$rating] ?? 0 }})</span>
                                </div>
                            @endfor

                            <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('Filter') }}</button>
                        </div>
                    </form>
                </div>

                <!-- Product Grid -->
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

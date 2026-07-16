@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb" style="background-image: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><span><i class="fas fa-chevron-right font-10"></i></span></li>
                        <li><span>Blog</span></li>
                    </ul>
                    <h3 class="prem-breadcrumb-title">Latest Blogs And Articles</h3>
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
                                <button class="nav-link active" id="pills-product-tab" data-bs-toggle="pill" data-bs-target="#pills-product" type="button" role="tab">All Item</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestMatch-tab" data-bs-toggle="pill" data-bs-target="#pills-bestMatch" type="button" role="tab">Best Match</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestRating-tab" data-bs-toggle="pill" data-bs-target="#pills-bestRating" type="button" role="tab">Best Rating</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab">Trending</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestSelling-tab" data-bs-toggle="pill" data-bs-target="#pills-bestSelling" type="button" role="tab">Best Selling</button>
                            </li>
                        </ul>
                    </div>

                    <form action="#" class="prem-filter-form">
                        <div class="row gy-3">
                            <div class="col-sm-4">
                                <div class="prem-input-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="tag">Tag</label>
                                        <button type="reset" class="clear-btn">Clear</button>
                                    </div>
                                    <input type="text" class="prem-form-control" id="tag" placeholder="Search By Tag...">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="prem-input-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="Price">Price</label>
                                        <button type="reset" class="clear-btn">Clear</button>
                                    </div>
                                    <input type="text" class="prem-form-control" id="Price" placeholder="$7 - $29">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="prem-input-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="time">Time Frame</label>
                                        <button type="reset" class="clear-btn">Clear</button>
                                    </div>
                                    <select id="time" class="prem-form-control">
                                        <option value="1">Now</option>
                                        <option value="2">Yesterday</option>
                                        <option value="3">1 Month Ago</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="prem-sidebar-widget">
                        <h4 class="prem-widget-title">Category</h4>
                        <ul class="prem-category-list">
                            <li><a href="#">All Categories <span class="qty">25489</span></a></li>
                            <li><a href="#">Site Template <span class="qty">12,501</span></a></li>
                            <li><a href="#">WordPress <span class="qty">1258</span></a></li>
                            <li><a href="#">UI Template <span class="qty">1520</span></a></li>
                            <li><a href="#">Templates Kits <span class="qty">210</span></a></li>
                            <li><a href="#">eCommerce <span class="qty">158</span></a></li>
                            <li><a href="#">Marketing <span class="qty">178</span></a></li>
                            <li><a href="#">CMS Template <span class="qty">122</span></a></li>
                            <li><a href="#">Blogging <span class="qty">155</span></a></li>
                        </ul>
                    </div>

                    <div class="prem-sidebar-widget">
                        <h4 class="prem-widget-title">Rating</h4>
                        <div class="prem-radio-group">
                            <label for="fiveStar">
                                <input type="radio" name="rating" id="fiveStar">
                                <span>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </span>
                            </label>
                            <span class="qty">(2530)</span>
                        </div>
                        <div class="prem-radio-group">
                            <label for="fourStar">
                                <input type="radio" name="rating" id="fourStar">
                                <span>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                </span>
                            </label>
                            <span class="qty">(1450)</span>
                        </div>
                        <div class="prem-radio-group">
                            <label for="threeStar">
                                <input type="radio" name="rating" id="threeStar">
                                <span>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                </span>
                            </label>
                            <span class="qty">(7580)</span>
                        </div>
                    </div>

                    <div class="prem-sidebar-widget">
                        <h4 class="prem-widget-title">Date Updated</h4>
                        <div class="prem-radio-group">
                            <label for="anyDate"><input type="radio" name="date" id="anyDate"> Any Date</label>
                            <span class="qty">5,203</span>
                        </div>
                        <div class="prem-radio-group">
                            <label for="lastYear"><input type="radio" name="date" id="lastYear"> In the last year</label>
                            <span class="qty">1,258</span>
                        </div>
                        <div class="prem-radio-group">
                            <label for="lastMonth"><input type="radio" name="date" id="lastMonth"> In the last month</label>
                            <span class="qty">2,450</span>
                        </div>
                        <div class="prem-radio-group">
                            <label for="lastWeek"><input type="radio" name="date" id="lastWeek"> In the last week</label>
                            <span class="qty">325</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-product" role="tabpanel">
                            <div class="row gy-4">
                                @foreach ($items as $item)
                                    <x-frontend.product-card :item="$item" />
                                @endforeach
                            </div>

                            <ul class="prem-pagination">
                                <li class="active"><a class="page-link" href="#">1</a></li>
                                <li><a class="page-link" href="#">2</a></li>
                                <li><a class="page-link" href="#">3</a></li>
                                <li><a class="page-link next-btn" href="#">Next <i class="fas fa-arrow-right"></i></a></li>
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="pills-bestMatch" role="tabpanel">
                            <div class="row gy-4">

                                <div class="col-lg-4 col-md-6">
                                    <div class="prem-card">
                                        <div class="prem-card-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('assets/images/thumbs/product-img1.png') }}" alt="">
                                            </a>
                                            <button type="button" class="prem-wishlist-btn"><i class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="prem-card-body">
                                            <div class="prem-card-meta">
                                                <div class="prem-stars">
                                                    <i class="fas fa-star"></i> <span>4.9 (16)</span>
                                                </div>
                                                <span class="sales"><i class="ti ti-download"></i> 1200</span>
                                            </div>
                                            <h6 class="prem-card-title">
                                                <a href="product-details.html">SaaS dashboard digital products Title here</a>
                                            </h6>
                                            <div class="prem-card-info">
                                                <span class="author">by <a href="profile.html">themepix</a></span>
                                                <div class="prem-price-wrap">
                                                    <span class="prem-price-old">$259</span>
                                                    <h6 class="prem-price-new">$120</h6>
                                                </div>
                                            </div>
                                            <div class="prem-card-footer">
                                                <a href="#" class="prem-btn-cart-full">
                                                    <i class="ti ti-shopping-cart-plus font-20"></i> Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="prem-card">
                                        <div class="prem-card-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('assets/images/thumbs/product-img2.png') }}" alt="">
                                            </a>
                                            <button type="button" class="prem-wishlist-btn"><i class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="prem-card-body">
                                            <div class="prem-card-meta">
                                                <div class="prem-stars">
                                                    <i class="fas fa-star"></i> <span>4.8 (89)</span>
                                                </div>
                                                <span class="sales"><i class="ti ti-download"></i> 3400</span>
                                            </div>
                                            <h6 class="prem-card-title">
                                                <a href="product-details.html">E-commerce Multi Vendor App Template</a>
                                            </h6>
                                            <div class="prem-card-info">
                                                <span class="author">by <a href="profile.html">themepix</a></span>
                                                <div class="prem-price-wrap">
                                                    <span class="prem-price-old">$199</span>
                                                    <h6 class="prem-price-new">$79</h6>
                                                </div>
                                            </div>
                                            <div class="prem-card-footer">
                                                <a href="#" class="prem-btn-cart-full">
                                                    <i class="ti ti-shopping-cart-plus font-20"></i> Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="prem-card">
                                        <div class="prem-card-thumb">
                                            <a href="product-details.html">
                                                <img src="{{ asset('assets/images/thumbs/product-img3.png') }}" alt="">
                                            </a>
                                            <button type="button" class="prem-wishlist-btn"><i class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="prem-card-body">
                                            <div class="prem-card-meta">
                                                <div class="prem-stars">
                                                    <i class="fas fa-star"></i> <span>5.0 (24)</span>
                                                </div>
                                                <span class="sales"><i class="ti ti-download"></i> 890</span>
                                            </div>
                                            <h6 class="prem-card-title">
                                                <a href="product-details.html">Admin Panel Vue React Tailwind Kit</a>
                                            </h6>
                                            <div class="prem-card-info">
                                                <span class="author">by <a href="profile.html">themepix</a></span>
                                                <div class="prem-price-wrap">
                                                    <span class="prem-price-old">$149</span>
                                                    <h6 class="prem-price-new">$59</h6>
                                                </div>
                                            </div>
                                            <div class="prem-card-footer">
                                                <a href="#" class="prem-btn-cart-full">
                                                    <i class="ti ti-shopping-cart-plus font-20"></i> Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

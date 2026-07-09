@extends('frontend.layouts.master')

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background: url({{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="assets/images/gradients/breadcrumb-gradient-bg.png" alt="" class="bg--gradient">
            <div class="container container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="breadcrumb-two-content text-center">

                            <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <a href="index.html" class="breadcrumb-list__link text-body hover-text-main">Home</a>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__icon font-10"><i class="fas fa-chevron-right"></i></span>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__text">Cart View</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">Cart View</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->

    <!-- ======================= Cart Section Start ======================== -->
    <div class="cart padding-y-120">
        <div class="container">
            <div class="cart-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="details">Product Details</th>
                                <th class="price">Price</th>
                                <th class="total">Total</th>
                                <th class="delete_cart">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItem as $cart)
                                <tr>
                                    <td class="details">
                                        <div class="cart-item">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="cart-item__thumb">
                                                    <a href="product-details.html" class="link">
                                                        @if ($cart->item->preview_type === 'image')
                                                            <img src="{{ asset($cart->item->preview_image) }}"
                                                                alt="" class="cover-img">
                                                        @elseif ($cart->item->preview_type === 'video')
                                                            <img src="{{ asset('defaults/video.webp') }}"
                                                                alt="{{ $cart->item->name }}" class="cover-img">
                                                        @elseif ($cart->item->preview_type === 'audio')
                                                            <img src="{{ asset('defaults/audio.webp') }}"
                                                                alt="{{ $cart->item->name }}" class="cover-img">
                                                        @endif

                                                    </a>
                                                </div>
                                                <div class="cart-item__content">
                                                    <h6
                                                        class="cart-item__title font-heading fw-700 text-capitalize font-18 mb-4">
                                                        <a href="product-details.html"
                                                            class="link">{{ $cart->item->name }}</a>
                                                    </h6>
                                                    <span class="cart-item__price font-18 text-heading fw-500">Category:
                                                        <span
                                                            class="text-body font-14">{{ $cart->item->category->name }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                              
                                    <td class="price">
                                        @if ($cart->item->discount_price > 0)
                                            <span class="cart-item__totalPrice text-heading font-18 fw-600 mb-0">
                                                ${{ $cart->item->discount_price }}
                                            </span>
                                            <span
                                                class="cart-item__oldPrice text-muted font-14 text-decoration-line-through ms-2">
                                                ${{ $cart->item->price }}
                                            </span>
                                        @else
                                            <span class="cart-item__totalPrice text-heading font-18 fw-600 mb-0">
                                                ${{ $cart->item->price }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="total">
                                        <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$56.00</span>
                                    </td>
                                    <td class="delete_cart">
                                        <span class="cart-item-remove" data-id="{{ $cart->id }}"><i
                                                class="ti ti-x"></i></span>
                                    </td>
                                </tr>

                            @empty
                                <div class="col-12">
                                    <div class="card border-dashed bg-transparent shadow-none py-5">
                                        <div class="card-body text-center">
                                            <h3 class="text-muted fw-bold">No Cart available</h3>
                                            <a href="{{ route('products') }}" class="btn btn-primary rounded-2 px-4 mt-2">
                                                <i class="ti ti-plus me-2"></i>Add Product
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="cart-content__bottom flx-between gap-2">
                    <a href="{{ route('products') }}" class="btn btn-outline-light flx-align gap-2 btn-lg">
                        <span class="icon line-height-1 font-20"><i class="las la-arrow-left"></i></span>
                        {{ __('Continue Shopping') }} </a>
                    <a href="{{ route('checkout') }}" class="btn btn-main flx-align gap-2 btn-lg">
                        {{ __('Next') }}
                        <span class="icon line-height-1 font-20"><i class="las la-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Cart Section End ======================== -->
@endsection

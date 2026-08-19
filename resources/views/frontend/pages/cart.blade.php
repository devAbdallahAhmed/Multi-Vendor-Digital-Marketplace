<style>

</style>

@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background: url('{{ asset(config('settings.breadcrumb')) }}') center center/cover no-repeat;">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">Home</a></li>
                        </li>
                        <li class="breadcrumb-item font-14 active"><span class="text-white opacity-50">Cart</span></li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Cart View') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="cart padding-y-120">
        <div class="container">
            <div class="cart-content">
                <div class="table-responsive">
                    <table class="table prem-cart-table">
                        <thead>
                            <tr>
                                <th class="details">Product Details</th>
                                <th class="price">Price</th>
                                <th class="total">Total</th>
                                <th class="delete_cart" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItem as $cart)
                                <tr>
                                    <td class="details">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="prem-thumb">
                                                <a href="product-details.html">
                                                    @if ($cart->item->preview_type === 'image')
                                                        <img src="{{ asset($cart->item->preview_image) }}" alt="">
                                                    @elseif ($cart->item->preview_type === 'video')
                                                        <img src="{{ asset('defaults/video.webp') }}" alt="">
                                                    @elseif ($cart->item->preview_type === 'audio')
                                                        <img src="{{ asset('defaults/audio.webp') }}" alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-800 text-dark mb-1">{{ $cart->item->name }}</h6>
                                                <span class="text-muted font-14">Category:
                                                    {{ $cart->item->category->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">
                                        @if ($cart->item->discount_price > 0)
                                            <span class="fw-800 text-dark font-18">${{ $cart->item->discount_price }}</span>
                                            <span
                                                class="text-muted font-14 text-decoration-line-through ms-2">${{ $cart->item->price }}</span>
                                        @else
                                            <span class="fw-800 text-dark font-18">${{ $cart->item->price }}</span>
                                        @endif
                                    </td>
                                    <td class="total">
                                        <span class="text-dark fw-600 font-18">$56.00</span>
                                    </td>
                                    <td class="delete_cart" style="text-align: center;">
                                        <span class="cart-item-remove" data-id="{{ $cart->id }}"><i
                                                class="ti ti-x"></i></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <h4 class="text-muted">No Items in Cart</h4>
                                        <a href="{{ route('products') }}" class="btn btn-primary mt-3">Add Products</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="prem-nav-btns">
                    <a href="{{ route('products') }}" class="btn btn-solid-secondary flx-align gap-2">
                        <i class="las la-arrow-left"></i> {{ __('Continue Shopping') }}
                    </a>
                    @if (getCartCount() > 0)
                        <a href="{{ route('checkout') }}" class="btn btn-main-prem flx-align gap-2">
                            {{ __('Next') }} <i class="las la-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

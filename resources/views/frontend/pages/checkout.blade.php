@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background: url('{{ asset(config('settings.breadcrumb')) }}') center center/cover no-repeat;">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li class="breadcrumb-item font-14">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item font-14">
                            <span class="font-10"><i class="fas fa-chevron-right"></i></span>
                        </li>
                        <li class="breadcrumb-item font-14 active">
                            <span class="text-white opacity-50">{{ __('Checkout') }}</span>
                        </li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Checkout') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="payment_page padding-y-120">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-8 col-lg-7">
                    <div class="payment_area">
                        <h4 class="mb-4">Select Payment Method</h4>
                        <div class="row g-3">
                            <div class="col-xl-3 col-6 col-md-4">
                                <a href="{{ route('payment.pay', ['gateway' => 'paypal']) }}" class="prem-payment-method">
                                    <img src="{{ asset('assets/front/images/thumbs/payment_2.png') }}" alt="payment"
                                        class="img-fluid">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4">
                                <a href="{{ route('payment.pay', ['gateway' => 'stripe']) }}" class="prem-payment-method">
                                    <img src="{{ asset('assets/front/images/thumbs/payment_4.png') }}" alt="payment"
                                        class="img-fluid">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="prem-summary-card">
                        <h4>Total Cart <span>({{ getCartCount() }})</span></h4>
                        <ul>
                            <li>Subtotal : <span>${{ getCartTotal() }}</span></li>
                        </ul>
                        <a href="#" class="prem-btn-main">Pay Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

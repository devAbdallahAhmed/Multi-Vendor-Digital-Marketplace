@php
    $footerSection = \App\Models\FooterSection::first();
    $socialLinks = \App\Models\SocialLink::all();
@endphp

<footer class="footer-section" style="background: url({{ asset('assets/front/images/shapes/footer-bg.png') }});">
    <div class="container">
        <div class="subscription pt_55 pb_45 "
            style="background: url({{ asset('assets/front/images/thumbs/subscrib_bg.jpg') }});">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="subscription_text">
                        <h2>Have a project? Create your website now.</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="subscription_right">
                        <form action="#">
                            <input type="text" placeholder="enter your mail">
                            <button class="btn btn-main btn-lg" type="submit">subscription</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-two">
        <div class="row gy-5">
            <div class="col-xl-3 col-sm-6">
                <div class="footer-widget">
                    <div class="footer-widget__logo">
                        <a href="index.html">
                            <img src="{{ asset('assets/front/images/logo/white-logo-two.png') }}" alt="">
                        </a>
                    </div>
                    <p class="footer-widget__desc">{{ $footerSection?->description }}</p>
                    <div class="footer-widget__social">
                        <ul class="social-icon-list">
                            @foreach ($socialLinks as $link)
                                <li class="social-icon-list__item">
                                    <a href="{{ $link->url }}" target="_blank"
                                        class="social-icon-list__link flx-center">
                                        <i class="{{ $link->icon }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-sm-6 col-xs-6">
                <div class="footer-widget">
                    <h5 class="footer-widget__title text-white">Useful Link</h5>
                    <ul class="footer-lists">
                        <li class="footer-lists__item"><a href="all-product.html" class="footer-lists__link">Product</a>
                        </li>
                        <li class="footer-lists__item"><a href="product-details.html" class="footer-lists__link">Product
                                Details</a></li>
                        <li class="footer-lists__item"><a href="profile.html" class="footer-lists__link">Profile</a>
                        </li>
                        <li class="footer-lists__item"><a href="cart.html" class="footer-lists__link">Shopping Cart</a>
                        </li>
                        <li class="footer-lists__item"><a href="dashboard.html" class="footer-lists__link">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-xs-6 ps-xl-5">
                <div class="footer-widget">
                    <h5 class="footer-widget__title text-white">Quick Links</h5>
                    <ul class="footer-lists">
                        <li class="footer-lists__item"><a href="dashboard.html" class="footer-lists__link">Dashboard</a>
                        </li>
                        <li class="footer-lists__item"><a href="login.html" class="footer-lists__link">Login</a></li>
                        <li class="footer-lists__item"><a href="register.html" class="footer-lists__link">Register</a>
                        </li>
                        <li class="footer-lists__item"><a href="blog.html" class="footer-lists__link">Blog </a></li>
                        <li class="footer-lists__item"><a href="blog-details.html" class="footer-lists__link">Blog
                                Details</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="footer_widget_count">
                    <ul>
                        @if ($footerSection?->item_sold)
                            <li>
                                <h4>{{ $footerSection->item_sold }}</h4>
                                <p>items sold</p>
                            </li>
                        @endif

                        @if ($footerSection?->community_earnings)
                            <li>
                                <h4>{{ $footerSection->community_earnings }}</h4>
                                <p>community earnings</p>
                            </li>
                        @endif
                    </ul>

                    @if ($footerSection?->gateway_image)
                        <div class="img">
                            <img src="{{ asset($footerSection->gateway_image) }}" alt="Payment"
                                class="img-fluid w-100">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="container container-two">
            <div class="bottom-footer__inner flx-between gap-3">
                <p class="bottom-footer__text font-14"> {{ $footerSection?->copyright }}</p>
                <div class="footer-links">
                    <a href="#" class="footer-link font-14">Terms of service</a>
                    <a href="#" class="footer-link font-14">Privacy Policy</a>
                    <a href="contact.html" class="footer-link font-14">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>

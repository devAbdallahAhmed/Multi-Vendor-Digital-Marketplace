<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Market Place HTML Template</title>
    <link rel="shortcut icon" href="{{ asset('assets/front/images/logo/favicon-two.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">

    @stack('styles')
</head>

<body>

    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="side-overlay"></div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <div class="mobile-menu d-lg-none d-block">
        <button type="button" class="close-button"> <i class="las la-times"></i> </button>
        <div class="mobile-menu__inner">
            <a href="#" class="mobile-menu__logo">
                <img src="{{ asset('assets/front/images/logo/logo-two.png') }}" alt="Logo" class="white-version">
            </a>
            <div class="mobile-menu__menu">
                <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">
                    <a href="#" class="header-right__button cart-btn position-relative">
                        <i class="ti ti-basket"></i>
                        <span class="qty-badge font-12">0</span>
                    </a>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('assets/front/images/icons/user.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sign Up</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="dashboard">
        <div class="dashboard__inner d-flex">

            @include('frontend.dashboard.layouts.sidebar')
            <div class="dashboard-body">
                @include('frontend.dashboard.layouts.nav')

                <div class="dashboard-body__content">
                    @yield('content')
                </div>

                <div class="dashboard-footer bottom-footer-two mt-32 border-0 bg-white">
                    <div class="bottom-footer__inner flx-between gap-3">
                        <p class="bottom-footer__text font-14"> Copyright © 2024 DigiMart, All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/front/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/front/js/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/front/js/apexchart.js') }}"></script>
    <script src="{{ asset('assets/front/js/marquee.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/infiniteslidev2.js') }}"></script>
    <script src="{{ asset('assets/front/js/select2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    <script src="{{ asset('assets/front/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/default/dashboard.js') }}"></script>


    @stack('scripts')
</body>

</html>

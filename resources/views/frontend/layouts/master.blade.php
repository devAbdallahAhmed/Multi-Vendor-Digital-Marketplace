<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Digital Market Place HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon-two.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome-all.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.css') }}">
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    <!-- Tabler Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css')}}"
        integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">


    <style>
        .fw-600 {
            font-weight: 600;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .rounded-4 {
            border-radius: 1.25rem !important;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: scale(1.01);
        }

        .upload-wrapper input[type="file"] {
            border: none;
            background: transparent;
        }
    </style>
    <style>
        .fw-600 {
            font-weight: 600;
        }

        .rounded-4 {
            border-radius: 1.25rem !important;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }
    </style>

</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader_area">
        <div class="preloader_img">
            <img src="assets/images/thumbs/preloader.gif" alt="Preloader">
        </div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Overlay Start ====================-->
    <div class="overlay"></div>
    <!--==================== Overlay End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ==================== Scroll to Top End Here ==================== -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- ==================== Scroll to Top End Here ==================== -->

    <!-- ==================== Mobile Menu Start Here ==================== -->
    <div class="mobile-menu d-lg-none d-block">
        <button type="button" class="close-button"> <i class="las la-times"></i> </button>
        <div class="mobile-menu__inner">
            <a href="index.html" class="mobile-menu__logo">
                <img src="{{ asset('assets/front/images/logo/logo-two.png') }}" alt="Logo" class="white-version">
            </a>
            <div class="mobile-menu__menu">
                <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">

                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('assets/front/images/icons/user.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Sign Up</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav-menu flx-align nav-menu--mobile">
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="index.html" class="nav-submenu__link"> Home One</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="index-two.html" class="nav-submenu__link"> Home Two</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="index-three.html" class="nav-submenu__link"> Home Three</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Products</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="all-product.html" class="nav-submenu__link"> All Products</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="product-details.html" class="nav-submenu__link"> Product Details</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Pages</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="profile.html" class="nav-submenu__link"> Profile</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Blog</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="blog.html" class="nav-submenu__link"> Blog</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="blog-details.html" class="nav-submenu__link"> Blog Details</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="blog-details-sidebar.html" class="nav-submenu__link"> Blog Details
                                    Sidebar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item">
                        <a href="contact.html" class="nav-menu__link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==================== Mobile Menu End Here ==================== -->

    <main class="change-gradient">
        <!-- ==================== Header Start Here ==================== -->
        @include('frontend.layouts.header')
        <!-- ==================== Header End Here ==================== -->

        <!-- ==================== Dynamic Content Here ==================== -->
        @yield('content')

        <!-- ==================== Footer Start Here ==================== -->
        @include('frontend.layouts.footer')
        <!-- ==================== Footer End Here ==================== -->

    </main>

    <!-- Jquery js -->
    <script src="{{ asset('assets/front/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('assets/front/js/boostrap.bundle.min.js') }}"></script>
    <!-- CountDown -->
    <script src="{{ asset('assets/front/js/countdown.js') }}"></script>
    <!-- counter up -->
    <script src="{{ asset('assets/front/js/counterup.min.js') }}"></script>
    <!-- Slick js -->
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/front/js/jquery.magnific-popup.js') }}"></script>
    <!-- apex chart -->
    <script src="{{ asset('assets/front/js/apexchart.js') }}"></script>
    <!-- marquee -->
    <script src="{{ asset('assets/front/js/marquee.min.js') }}"></script>
    <!-- infinite slide  -->
    <script src="{{ asset('assets/front/js/infiniteslidev2.js') }}"></script>
    <!-- select 2  -->
    <script src="{{ asset('assets/front/js/select2.min.js') }}"></script>
    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>
    <!-- main js -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>


    @stack('scripts')
</body>

</html>

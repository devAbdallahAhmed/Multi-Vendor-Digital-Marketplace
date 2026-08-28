<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Digital Product Marketplace </title>
    <link rel="shortcut icon" href="{{ asset(config('settings.favicon')) }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.8.4/plyr.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
        integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">

    <style>

    </style>
    @routes
</head>

<body>


    <div class="overlay"></div>

    <div class="side-overlay"></div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <div class="mobile-menu d-lg-none d-block">
        <button type="button" class="close-button"> <i class="las la-times"></i> </button>

    </div>

    <main class="change-gradient">
        @include('frontend.layouts.header')

        @yield('content')

        @include('frontend.layouts.footer')
    </main>

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
    <script src="https://cdn.plyr.io/3.8.4/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    <script src="{{ asset('assets/front/js/default/default-variables.js') }}"></script>
    <script src="{{ asset('assets/front/js/default/cart.js') }}"></script>

    @stack('scripts')
</body>

</html>

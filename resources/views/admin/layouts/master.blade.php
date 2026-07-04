<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ __('Dashboard') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
        integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/tabler.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/side.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tagsinput.css') }}">

    @livewireStyles
    @stack('styles')
</head>

<body>
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="page">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.header')
        @yield('content')
    </div>

    <script src="{{ asset('assets/admin/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jsvectormap/dist/maps/world-merc.js') }}"></script>

    <script src="{{ asset('assets/admin/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/admin/js/default/admin.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tagsinput.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>


    @stack('scripts')
</body>

</html>


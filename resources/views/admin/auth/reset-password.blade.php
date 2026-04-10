<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ __('Reset Password') }} - Admin</title>
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('assets/admin/img/static/logo.svg') }}" width="110" height="32"
                        alt="Tabler" class="navbar-brand-image">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">{{ __('Reset Password') }}</h2>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('admin.password.store') }}" autocomplete="off" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label">{{ __('Email address') }}</label>
                            <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                                class="form-control" placeholder="your@email.com" autocomplete="off" readonly>
                            @if ($errors->has('email'))
                                <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('New Password') }}</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" required autocomplete="new-password"
                                    class="form-control" placeholder="{{ __('Your new password') }}"
                                    autocomplete="off">
                            </div>
                            @if ($errors->has('password'))
                                <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password_confirmation" required autocomplete="new-password"
                                    class="form-control" placeholder="{{ __('Confirm your password') }}"
                                    autocomplete="off">
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <div class="text-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center text-secondary mt-3">
                {{ __('Back to') }} <a href="{{ route('admin.login') }}" tabindex="-1">{{ __('Sign In') }}</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/tabler.min.js') }}?1692870487" defer></script>
    <script src="{{ asset('assets/admin/js/demo.min.js') }}?1692870487" defer></script>
</body>

</html>

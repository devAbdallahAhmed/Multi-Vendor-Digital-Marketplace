<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in - Admin Panel</title>
    <link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        @media (min-width: 992px) {
            .page-wrapper-split {
                display: flex;
                min-height: 100vh;
            }
            .split-col-form {
                flex: 0 0 45%;
                max-width: 45%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: var(--tblr-bg-surface);
            }
            .split-col-image {
                flex: 0 0 55%;
                max-width: 55%;
                position: relative;
            }
            .split-image-bg {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            .split-image-bg::before {
                content: '';
                position: absolute;
                top: 0; right: 0; bottom: 0; left: 0;
                background: rgba(0, 0, 0, 0.1);
            }
        }

        @media (max-width: 991px) {
            .split-col-image {
                display: none;
            }
            .page-single {
                margin-top: 4rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column bg-white">
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>

    <div class="page page-center page-wrapper-split">
        <div class="row g-0 flex-fill">

            <div class="col-12 col-lg-6 split-col-image order-lg-last">
                <div class="split-image-bg" style="background-image: url('{{ asset('assets/admin/img/static/admin.jfif') }}')">
                </div>
            </div>

            <div class="col-12 col-lg-6 split-col-form order-lg-first">
                <div class="container container-tight py-4 px-lg-5">
                  

                    <div class="card card-md border-0 shadow-none bg-transparent">
                        <div class="card-body p-0">
                            <h2 class="h2 text-center mb-4">{{ __('Login to your Admin account') }}</h2>

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('admin.login') }}" autocomplete="off" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email address') }}</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control"
                                        placeholder="admin@email.com" autocomplete="off">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">
                                        {{ __('Password') }}
                                        <span class="form-label-description">
                                            <a href="{{ route('admin.password.request') }}">{{ __('I forgot password') }}</a>
                                        </span>
                                    </label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password" required autocomplete="current-password"
                                            class="form-control" placeholder="{{ __('Your password') }}" autocomplete="off">
                                        <span class="input-group-text">
                                            <a href="#" class="link-secondary" title="Show password"
                                                data-bs-toggle="tooltip">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="mb-2">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" />
                                        <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('Sign In') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/admin/js/demo.min.js') }}" defer></script>
</body>
</html>

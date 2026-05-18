<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; color: #343a40;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; background-color: #ffffff; margin: 40px auto; border: 1px solid #dee2e6; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">

        <tr>
            <td align="center" style="padding: 35px 20px; background-color: #0d6efd; color: #ffffff;">
                <h1 style="margin: 0; font-size: 26px; font-weight: 700; letter-spacing: -0.5px;">
                    {{ config('app.name') }}
                </h1>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #e9ecef; opacity: 0.9;">
                    {{ __('Security & Verification Service') }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="font-size: 20px; font-weight: 600; margin-top: 0; color: #212529;">
                    {{ __('Hello') }} {{ $name }},
                </h2>

                <p style="font-size: 16px; line-height: 1.6; color: #495057; margin-bottom: 25px;">
                    {{ $content }}
                </p>

                <p style="font-size: 15px; line-height: 1.6; color: #6c757d;">
                    {{ __('If you have any questions or believe this was a mistake, please contact our support team immediately.') }}
                </p>

                <div style="text-align: center; margin-top: 35px;">
                    <a href="{{ route('home') }}"
                        style="display: inline-block; padding: 12px 30px; background-color: #0d6efd; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: 600; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                        {{ __('Go to Dashboard') }}
                    </a>
                </div>
            </td>
        </tr>

        <tr>
            <td align="center"
                style="padding: 25px 20px; background-color: #f8f9fa; color: #6c757d; font-size: 13px; border-top: 1px solid #dee2e6;">
                <p style="margin: 0 0 8px 0; font-weight: 500;">
                    {{ config('app.name') }} &copy; {{ date('Y') }}. {{ __('All rights reserved.') }}
                </p>
                <p style="margin: 0;">
                    <a href="#"
                        style="color: #0d6efd; text-decoration: none; margin: 0 5px;">{{ __('Privacy Policy') }}</a> |
                    <a href="#"
                        style="color: #0d6efd; text-decoration: none; margin: 0 5px;">{{ __('Support') }}</a>
                </p>
            </td>
        </tr>
    </table>

</body>

</html>

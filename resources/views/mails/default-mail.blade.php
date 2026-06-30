<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; background-color: #f4f6f9; color: #2d3748;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; margin: 40px auto; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); overflow: hidden; border-collapse: separate;">
        
        <tr>
            <td align="left" style="padding: 40px 40px 30px 40px; background-color: #ffffff; border-bottom: 1px solid #edf2f7;">
                <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #1a0dab; letter-spacing: -0.5px;">
                    {{ config('app.name') }}
                </h1>
                <p style="margin: 6px 0 0 0; font-size: 13px; font-weight: 600; color: #718096; text-transform: uppercase; letter-spacing: 1px;">
                    {{ __('Review & Status Service') }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 40px 40px 30px 40px;">
                <h2 style="font-size: 20px; font-weight: 700; margin-top: 0; color: #1a202c; letter-spacing: -0.3px;">
                    {{ __('Hello') }} {{ $name }},
                </h2>

                <p style="font-size: 16px; line-height: 1.7; color: #4a5568; margin-bottom: 30px; margin-top: 15px;">
                    {{ $content }}
                </p>

                <div style="background-color: #f8fafc; border-left: 4px solid #0d6efd; padding: 16px 20px; border-radius: 0 8px 8px 0; margin-bottom: 35px;">
                    <p style="font-size: 14px; line-height: 1.6; color: #4a5568; margin: 0;">
                        {{ __('If you have any questions or believe this was a mistake, please contact our support team immediately.') }}
                    </p>
                </div>

             <div style="text-align: center; margin: 20px 0 10px 0;">
                    <a href="{{ route('dashboard') }}" style="display: inline-block; padding: 14px 36px; background-color: #0d6efd; color: #ffffff; text-decoration: none; border-radius: 8px; font-size: 15px; font-weight: 700; box-shadow: 0 4px 6px rgba(13,110,253,0.15); transition: background-color 0.2s ease;">
                        {{ __('Go to Dashboard') }}
                    </a>
                </div>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 30px 40px; background-color: #f8fafc; color: #718096; font-size: 13px; border-top: 1px solid #edf2f7;">
                <p style="margin: 0 0 10px 0; font-weight: 500; line-height: 1.5;">
                    {{ config('app.name') }} &copy; {{ date('Y') }}. {{ __('All rights reserved.') }}
                </p>
                <p style="margin: 0; font-weight: 600;">
                    <a href="#" style="color: #0d6efd; text-decoration: none; margin: 0 8px;">{{ __('Privacy Policy') }}</a> 
                    <span style="color: #e2e8f0;">|</span>
                    <a href="#" style="color: #0d6efd; text-decoration: none; margin: 0 8px;">{{ __('Support') }}</a>
                </p>
            </td>
        </tr>

    </table>

</body>

</html>
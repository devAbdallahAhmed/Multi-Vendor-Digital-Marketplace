<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function ($app) {
            return new SettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingService = $this->app->make(SettingService::class);
        $settingService->setSetting();

        // Overriding default SMTP Mailer settings with database values
        Config::set('mail.mailers.smtp.host', config('settings.smtp_host'));
        Config::set('mail.mailers.smtp.port', config('settings.smtp_port'));
        Config::set('mail.mailers.smtp.username', config('settings.smtp_username'));
        Config::set('mail.mailers.smtp.password', config('settings.smtp_password'));
        Config::set('mail.mailers.smtp.encryption', config('settings.smtp_encryption'));

        // Overriding the default "From" address settings
        Config::set('mail.from.address', config('settings.smtp_sender_email'));
        Config::set('mail.from.name', config('settings.smtp_sender_name'));
    }
}

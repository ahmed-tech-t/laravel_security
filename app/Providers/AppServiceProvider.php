<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            // Return the URL of your SPA/Mobile app reset page
            return 'https://your-frontend-link.com/reset-password?token=' . $token . '&email=' . $notifiable->getEmailForPasswordReset();
        });
    }
}

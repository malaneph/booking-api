<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Carbon::macro('inApplicationTimezone', function () {
            return $this->tz(config('app.timezone'));
        });

        Carbon::macro('inUserTimezone', function () {
           return $this->tz(auth()->user()?->timezone ?? config('app.timezone'));
        });
    }
}

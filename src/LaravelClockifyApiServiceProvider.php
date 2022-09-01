<?php

namespace Ping\LaravelClockifyApi;

use Illuminate\Support\ServiceProvider;
use Ping\LaravelClockifyApi\API\ClockifyUsers;
use Ping\LaravelClockifyApi\Reports\ClockifyDetailedReport;
use Ping\LaravelClockifyApi\Reports\ClockifySummaryReport;

class LaravelClockifyApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/clockify.php' => config_path('clockify.php'),
        ], 'clockify-config');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/clockify.php', 'clockify');

        $this->app->singleton(ClockifyUsers::class, fn () => new ClockifyUsers());
        $this->app->singleton(ClockifyDetailedReport::class, fn () => new ClockifyDetailedReport());
        $this->app->singleton(ClockifySummaryReport::class, fn () => new ClockifySummaryReport());
    }
}

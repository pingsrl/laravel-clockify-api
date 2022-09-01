<?php

namespace Sourceboat\LaravelClockifyApi;

use Illuminate\Support\ServiceProvider;
use Sourceboat\LaravelClockifyApi\Reports\ClockifyDetailedReport;
use Sourceboat\LaravelClockifyApi\Reports\ClockifyReport;
use Sourceboat\LaravelClockifyApi\Reports\ClockifySummaryReport;

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

        $this->app->singleton(ClockifyReport::class, fn () => new ClockifyReport());
        $this->app->singleton(ClockifyDetailedReport::class, fn () => new ClockifyDetailedReport());
        $this->app->singleton(ClockifySummaryReport::class, fn () => new ClockifySummaryReport());
    }
}

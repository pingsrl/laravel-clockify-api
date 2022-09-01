<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\Reports\ClockifySummaryReport;
use Ping\LaravelClockifyApi\Tests\TestCase;

class SummaryReportTest extends TestCase
{
    private array $userIds = [1, 2, 3];

    public function test(): void
    {
        Http::fake();

        app(ClockifySummaryReport::class)
            ->users($this->userIds)
            ->get();

        Http::assertSent(function ($request) {
            return count($request['users']['ids']) === count($this->userIds);
        });
    }
}

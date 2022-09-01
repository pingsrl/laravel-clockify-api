<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
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

        Http::assertSent(function (Request $request) {
            $this->assertEquals('https://reports.api.clockify.me/v1/workspaces/'.config('clockify.workspace_id').'/reports/summary', $request->url());

            return count($request['users']['ids']) === count($this->userIds);
        });
    }
}

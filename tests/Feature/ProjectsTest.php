<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\API\ClockifyProjects;
use Ping\LaravelClockifyApi\Tests\TestCase;

class ProjectsTest extends TestCase
{
    public function test(): void
    {
        Http::fake();

        app(ClockifyProjects::class)
            ->forUsers([1, 2, 3])
            ->get();

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/projects', $request->url());
            $this->assertEquals('NAME', $request['sortColumn']);
            $this->assertEquals([1, 2, 3], $request['users']);
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}

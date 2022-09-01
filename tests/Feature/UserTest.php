<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\API\ClockifyUsers;
use Ping\LaravelClockifyApi\Tests\TestCase;

class UserTest extends TestCase
{
    public function test(): void
    {
        Http::fake();

        app(ClockifyUsers::class)
            ->get();

        Http::assertSent(function (Request $request) {
            $this->assertEquals('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/users', $request->url());
            $this->assertEquals('NAME', $request['sortColumn']);

            return true;
        });
    }
}

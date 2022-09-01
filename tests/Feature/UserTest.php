<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

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

        Http::assertSent(function ($request) {
            return 'NAME' === $request['sortColumn'];
        });
    }
}

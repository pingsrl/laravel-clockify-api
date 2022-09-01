<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\API\ClockifyClients;
use Ping\LaravelClockifyApi\Tests\TestCase;

class ClientsTest extends TestCase
{
    public function test(): void
    {
        Http::fake();

        app(ClockifyClients::class)
            ->byName('test')
            ->get();

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/clients', $request->url());
            $this->assertEquals('NAME', $request['sortColumn']);
            $this->assertEquals('test', $request['name']);
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }
}

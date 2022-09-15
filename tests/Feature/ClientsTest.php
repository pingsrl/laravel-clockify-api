<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\API\ClockifyClients;
use Ping\LaravelClockifyApi\Payloads\ClockifyClient;
use Ping\LaravelClockifyApi\Tests\TestCase;

class ClientsTest extends TestCase
{
    public function testCanLoadOnePage(): void
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

    public function testCanLoadMultiplePages(): void
    {
        Http::fake();

        app(ClockifyClients::class)
            ->byName('test')
            ->getAll();

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/clients', $request->url());
            $this->assertEquals('NAME', $request['sortColumn']);
            $this->assertEquals('test', $request['name']);
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }

    public function testCanAddClient(): void
    {
        Http::fake();

        app(ClockifyClients::class)
            ->add(
                ClockifyClient::make()->name('Client X')
            );

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/clients', $request->url());
            $this->assertEquals('Client X', $request['name']);
            $this->assertEquals('POST', $request->method());

            return true;
        });
    }

    public function testCanUpdateClient(): void
    {
        Http::fake();

        app(ClockifyClients::class)
            ->update(
                ClockifyClient::make('xxxx')->name('Client X')
            );

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/clients/xxxx', $request->url());
            $this->assertEquals('Client X', $request['name']);
            $this->assertEquals('PUT', $request->method());

            return true;
        });
    }

    public function testCanDeleteClient(): void
    {
        Http::fake();

        app(ClockifyClients::class)
            ->delete(
                ClockifyClient::make('xxxx')->name('Client X')
            );

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/clients/xxxx', $request->url());
            $this->assertEquals('DELETE', $request->method());

            return true;
        });
    }
}

<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Ping\LaravelClockifyApi\API\ClockifyTasks;
use Ping\LaravelClockifyApi\Payloads\ClockifyTask;
use Ping\LaravelClockifyApi\Tests\TestCase;

class TasksTest extends TestCase
{
    public function test(): void
    {
        Http::fake();

        app(ClockifyTasks::class)
            ->forProjectId('xxxx')
            ->get();

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/projects/xxxx/tasks', $request->url());
            $this->assertEquals(true, $request['isActive']);
            $this->assertEquals('GET', $request->method());

            return true;
        });
    }

    public function testCanAddTask(): void
    {
        Http::fake();

        app(ClockifyTasks::class)
            ->forProjectId('xxxx')
            ->add(
                ClockifyTask::make()->name('Task X')
            );

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/projects/xxxx/tasks', $request->url());
            $this->assertEquals('Task X', $request['name']);
            $this->assertEquals('POST', $request->method());

            return true;
        });
    }

    public function testCanUpdateTask(): void
    {
        Http::fake();

        app(ClockifyTasks::class)
            ->forProjectId('xxxx')
            ->update(
                ClockifyTask::make('yyyy')->name('Task Y')
            );

        Http::assertSent(function (Request $request) {
            $this->assertStringContainsString('https://api.clockify.me/api/v1/workspaces/'.config('clockify.workspace_id').'/projects/xxxx/tasks/yyyy', $request->url());
            $this->assertEquals('Task Y', $request['name']);
            $this->assertEquals('PUT', $request->method());

            return true;
        });
    }
}

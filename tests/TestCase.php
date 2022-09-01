<?php

namespace Ping\LaravelClockifyApi\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Config::set('clockify.api_key', env('CLOCKIFY_API_KEY'));
        Config::set('clockify.workspace_id', env('CLOCKIFY_WORKSPACE_ID'));
    }
}

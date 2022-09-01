<?php

namespace Ping\LaravelClockifyApi\API;

use Ping\LaravelClockifyApi\ClockifyClient;

abstract class ClockifyAPI extends ClockifyClient
{
    protected const ENDPOINT = 'https://api.clockify.me/api/v1';

    protected string $method = 'get';
}

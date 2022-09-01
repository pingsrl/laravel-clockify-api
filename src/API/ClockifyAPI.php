<?php

namespace Ping\LaravelClockifyApi\API;

use Ping\LaravelClockifyApi\ClockifyClient;
use Ping\LaravelClockifyApi\Traits\HasPages;

abstract class ClockifyAPI extends ClockifyClient
{
    use HasPages;

    protected const ENDPOINT = 'https://api.clockify.me/api/v1';

    protected string $method = 'get';
}

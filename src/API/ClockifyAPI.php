<?php

namespace Ping\LaravelClockifyApi\API;

use Ping\LaravelClockifyApi\ClockifyClient;

abstract class ClockifyAPI extends ClockifyClient
{
    private const ENDPOINT = 'https://api.clockify.me/api/v1';
}
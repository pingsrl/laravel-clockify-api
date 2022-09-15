<?php

namespace Ping\LaravelClockifyApi\Payloads;

class ClockifyClient extends Payload
{
    protected array $parameters = [
        'name',
        'note',
        'archived',
    ];

    protected array $required = [
        'name',
    ];
}

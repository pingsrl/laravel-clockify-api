<?php

namespace Ping\LaravelClockifyApi\Payloads;

class ClockifyProject extends Payload
{
    protected array $parameters = [
        'name',
        'clientId',
        'isPublic',
        'color',
        'note',
        'billable',
        'public',
        'archived',
    ];

    protected array $required = [
        'name',
    ];
}

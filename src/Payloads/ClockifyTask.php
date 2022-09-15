<?php

namespace Ping\LaravelClockifyApi\Payloads;

class ClockifyTask extends Payload
{
    protected array $parameters = [
        'name',
        'assigneeIds',
        'estimate',
        'status', // ACTIVE, DONE
    ];

    protected array $required = [
        'name',
    ];
}

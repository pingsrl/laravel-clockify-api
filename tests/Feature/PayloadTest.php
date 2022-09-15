<?php

namespace Ping\LaravelClockifyApi\Tests\Feature;

use Ping\LaravelClockifyApi\Exceptions\InvalidPayloadException;
use Ping\LaravelClockifyApi\Payloads\ClockifyClient;
use Ping\LaravelClockifyApi\Tests\TestCase;

class PayloadTest extends TestCase
{
    public function testClientPayload(): void
    {
        $payload = ClockifyClient::make()->name('Client X');
        $data = $payload->getData();

        $this->assertEquals($data['name'], 'Client X');
    }

    public function testClientPayloadRequired(): void
    {
        $this->expectException(InvalidPayloadException::class);

        $payload = ClockifyClient::make();
        $payload->validate()->getData();
    }
}

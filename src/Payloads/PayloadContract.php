<?php

namespace Ping\LaravelClockifyApi\Payloads;

interface PayloadContract
{
    public function getResourceEndpoint(): string;

    public function isValid(): bool;

    public function validate(): static;

    public function getData(): array;
}

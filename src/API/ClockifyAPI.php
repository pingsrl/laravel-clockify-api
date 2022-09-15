<?php

namespace Ping\LaravelClockifyApi\API;

use Illuminate\Support\Collection;
use Ping\LaravelClockifyApi\ClockifyClient;
use Ping\LaravelClockifyApi\Payloads\PayloadContract;
use Ping\LaravelClockifyApi\Traits\HasPages;

abstract class ClockifyAPI extends ClockifyClient
{
    use HasPages;

    protected const ENDPOINT = 'https://api.clockify.me/api/v1';

    public function get(): Collection
    {
        $this->method = 'get';

        $response = $this->executeApiCall();

        return $this->parseResponse($response);
    }

    public function add(PayloadContract $payload): Collection
    {
        $this->method = 'post';

        $data = $payload->validate()->getData();

        $response = $this->executeApiCall(data: $data);

        return $this->parseResponse($response);
    }

    public function update(PayloadContract $payload): Collection
    {
        $this->method = 'put';

        $data = $payload->validate()->getData();

        $response = $this->executeApiCall(resource_endpoint: $payload->getResourceEndpoint(), data: $data);

        return $this->parseResponse($response);
    }

    public function delete(PayloadContract $payload): Collection
    {
        $this->method = 'delete';

        $data = [];

        $response = $this->executeApiCall(resource_endpoint: $payload->getResourceEndpoint(), data: $data);

        return $this->parseResponse($response);
    }
}

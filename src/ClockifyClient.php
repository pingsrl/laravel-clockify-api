<?php

namespace Ping\LaravelClockifyApi;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use stdClass;

abstract class ClockifyClient
{
    use ConditionallyLoadsAttributes;

    protected string $method = 'get';

    protected const ENDPOINT = '';

    private array $headers = [];

    protected string $workspaceId = '';

    abstract protected function requestData();

    public function __construct()
    {
        $this->headers = [
            'X-Api-Key' => config('clockify.api_key'),
        ];
        $this->workspaceId = config('clockify.workspace_id');
    }

    public function get(): Collection
    {
        return $this->parseCollectionResponse($this->executeApiCall());
    }

    protected function parseResponse(Response $response): null|array|stdClass
    {
        return json_decode($response->body());
    }

    protected function parseCollectionResponse(Response $response): Collection
    {
        return collect($this->parseResponse($response));
    }

    protected function getEndpoint()
    {
        return '/workspaces/'.$this->workspaceId.$this->endpoint;
    }

    protected function executeApiCall(string $resource_endpoint = '', array $data = null)
    {
        $endpoint = $this->getEndpoint().$resource_endpoint;
        $method = $this->method ?? 'get';
        $data = $data ?: $this->requestData();

        return Http::withHeaders($this->headers)->$method(
            static::ENDPOINT.$endpoint,
            $data,
        );
    }
}

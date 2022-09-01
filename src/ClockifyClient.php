<?php

namespace Ping\LaravelClockifyApi;

use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

abstract class ClockifyClient
{
    use ConditionallyLoadsAttributes;

    protected string $method = 'get';

    protected const ENDPOINT = '';

    private array $headers = [];

    private string $workspaceId = '';

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
        return collect(json_decode($this->executeApiCall()->body()));
    }

    public function executeApiCall()
    {
        $endpoint = '/workspaces/'.$this->workspaceId.$this->endpoint;
        $method = $this->method ?? 'get';

        return Http::withHeaders($this->headers)->$method(
            static::ENDPOINT.$endpoint,
            $this->requestData(),
        );
    }
}

<?php

namespace Ping\LaravelClockifyApi;

use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Support\Facades\Http;

abstract class ClockifyClient
{
    use ConditionallyLoadsAttributes;

    private const ENDPOINT = '';

    private array $headers = [];

    private string $workspaceId = '';

    abstract public function get();

    abstract protected function requestData();

    public function __construct()
    {
        $this->headers = [
            'X-Api-Key' => config('clockify.api_key'),
        ];
        $this->workspaceId = config('clockify.workspace_id');
    }

      public function executeApiCall()
      {
          $endpoint = '/workspaces/'.$this->workspaceId.$this->endpoint;

          return Http::withHeaders($this->headers)->post(
              self::ENDPOINT.$endpoint,
              $this->requestData(),
          );
      }
}

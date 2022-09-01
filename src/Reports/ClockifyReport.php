<?php

namespace Ping\LaravelClockifyApi\Reports;

use Illuminate\Support\Collection;
use Ping\LaravelClockifyApi\ClockifyClient;
use Ping\LaravelClockifyApi\Reports\Traits\HasTags;
use Ping\LaravelClockifyApi\Reports\Traits\HasTimes;

abstract class ClockifyReport extends ClockifyClient
{
    use HasTags;
    use HasTimes;

    protected const ENDPOINT = 'https://reports.api.clockify.me/v1';

    protected $userIds = null;

    protected $taskIds = null;

    protected string $endpoint = '';

    protected string $sortOrder = '';

    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->dateRangeStart = now()->startOfYear();
        $this->dateRangeEnd = now()->endOfYear();
    }

    public function get(): Collection
    {
        return collect(json_decode($this->executeApiCall()->body()));
    }

    public function users(array $userIds)
    {
        $this->userIds = $userIds;

        return $this;
    }

    public function tasks(array $taskIds)
    {
        $this->taskIds = $taskIds;

        return $this;
    }

    public function sortOrder(string $sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}

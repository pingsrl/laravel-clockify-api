<?php

namespace Ping\LaravelClockifyApi\API;

use Illuminate\Support\Collection;

class ClockifyUsers extends ClockifyAPI
{
    protected string $endpoint = '/users';

    private int $page = 1;

    private int $pageSize = 50;

    private string $status = 'ACTIVE';

    public function get(): Collection
    {
        return collect(json_decode($this->executeApiCall('get')->body()));
    }

    protected function requestData()
    {
        return $this->filter((array) [
            'page' => $this->page,
            'pageSize' => $this->pageSize,
            'sortColumn' => 'NAME',
            $this->mergeWhen('' !== $this->status, [
                'status' => $this->status,
            ]),
        ]);
    }

    public function status(string $status)
    {
        $this->status = $status;

        return $this;
    }
}

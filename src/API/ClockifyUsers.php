<?php

namespace Ping\LaravelClockifyApi\API;

class ClockifyUsers extends ClockifyAPI
{
    protected string $endpoint = '/user';

    private int $page = 1;

    private int $pageSize = 50;

    public function get()
    {
        return json_decode($this->executeApiCall()->body());
    }

    protected function requestData()
    {
        return $this->filter((array) [
            'page' => $this->page,
            'pageSize' => $this->pageSize,
            'sortColumn' => 'NAME',
        ]);
    }
}

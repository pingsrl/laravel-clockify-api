<?php

namespace Ping\LaravelClockifyApi\API;

class ClockifyUsers extends ClockifyAPI
{
    protected string $endpoint = '/users';

    private string $status = 'ACTIVE';

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

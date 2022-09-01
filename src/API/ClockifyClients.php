<?php

namespace Ping\LaravelClockifyApi\API;

class ClockifyClients extends ClockifyAPI
{
    protected string $endpoint = '/clients';

    private bool $archived = false;

    private string $name = '';

    protected function requestData()
    {
        return $this->filter((array) [
            'page' => $this->page,
            'pageSize' => $this->pageSize,
            'sortColumn' => 'NAME',
            'archived' => $this->archived,
            $this->mergeWhen('' !== $this->name, [
                'name' => $this->name,
            ]),
        ]);
    }

    public function byName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function archived(bool $archived)
    {
        $this->archived = $archived;

        return $this;
    }
}

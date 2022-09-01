<?php

namespace Ping\LaravelClockifyApi\API;

use Illuminate\Support\Collection;

class ClockifyProjects extends ClockifyAPI
{
    protected string $endpoint = '/projects';

    private int $page = 1;

    private int $pageSize = 50;

    private string $clientStatus = 'ACTIVE';

    private string $userStatus = 'ACTIVE';

    private array $users = [];

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
            $this->mergeWhen('' !== $this->clientStatus, [
                'clientStatus' => $this->clientStatus,
            ]),
            $this->mergeWhen([] !== $this->users, [
                'users' => $this->users,
            ]),
            $this->mergeWhen('' !== $this->userStatus, [
                'userStatus' => $this->userStatus,
            ]),
        ]);
    }

    public function forUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }

    public function clientStatus(string $clientStatus)
    {
        $this->clientStatus = $clientStatus;

        return $this;
    }

    public function userStatus(string $userStatus)
    {
        $this->userStatus = $userStatus;

        return $this;
    }
}

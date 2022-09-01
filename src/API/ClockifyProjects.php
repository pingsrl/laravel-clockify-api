<?php

namespace Ping\LaravelClockifyApi\API;

class ClockifyProjects extends ClockifyAPI
{
    protected string $endpoint = '/projects';

    private string $clientStatus = 'ACTIVE';

    private string $userStatus = 'ACTIVE';

    private array $users = [];

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
